/**
 * Class for the dynamic menu.
 *
 * Requires Prototype JS version 1.5.0 or greater.
 * (Also supports version 1.6.0.*, avoiding all deprecated methods)
 * http://www.prototypejs.org/
 *
 * As of version 1.2, released under the MIT License:
 *
 * Copyright (c) 2007-2009 Charming Design, Niek Kouwenberg
 * http://www.charmingdesign.net/
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * Special thanks to CARE Internet Services B.V.
 * http://www.care.nl/
 */
var Menu = Class.create({

	/* Version of the Menu class */
	Version: "1.2",


	/*
	 * CONSTANTS
	 */

	/* Constant for a horizontal menu */
	HORIZONTAL: 1,

	/* Constant for a vertical menu */
	VERTICAL: 2,


	/*
	 * MENU
	 */

	/* Hold the ID of the menu */
	_menuId: null,

	/* Hold the menu UL node */
	_menuNode: null,


	/*
	 * TEMPORARY VARIABLES
	 */

	/* Hold the hide timer */
	_hideTimeout: null,

	/* Will hold the link, submenu and level of the active menu node */
	_activeNodes: new Array(),


	/*
	 * OPTIONS
	 */

	/* Orientation of the menu (horizontal or vertical) */
	_orientation: 1,

	/* Time in milliseconds before hiding the sub menu */
	_hidePause: 1000,

	/* Opacity (0 = transparent, 1 = opaque) */
	_opacity: 1,


	/*
	 * METHODS
	 */

	/**
	 * Sets the time to wait before hiding the sub menu.
	 *
	 * @param	int		secs
	 *
	 * @deprecated Please use the options argument for Menu.init() instead.
	 */
	setHidePause: function(secs)
	{
		this._hidePause = secs * 1000;

		/* deprecation warning */
		alert("Deprecated method Menu.setHidePause() used: Please use the options argument for Menu.init().");
	}, // function setHidePause

	/**
	 * Initializes the dynamic menu.
	 *
	 * @param	string	menuId
	 * @param	object	options
	 *
	 * Available options:
	 * - orientation (int, Menu.HORIZONTAL or Menu.VERTICAL)
	 * - hidePause (float, seconds)
	 * - opacity (float; 0 = transparent, 1 = opaque, transparency of the sub menu)
	 *
	 * Example usage:
	 * <script type="text/javascript">
	 *     Menu.init("menu", {"hidePause": 0.5});
	 * </script>
	 *
	 * This method can be called after document load, but it is preferred to be
	 * called directly from your page (HTML <head>, before document load). This
	 * way the menu loads faster and can be interacted with much sooner.
	 */
	init: function(menuId, options)
	{
		/* Save menu ID (fall back to the default ID "menu") */
		this._menuId = (typeof menuId == "string") ? menuId : "menu";

		/* Save options */
		if (options)
		{
			/* Orientation */
			if (options.orientation != undefined)
			{
				this._orientation = options.orientation;
			}
			/* Hide timeout in seconds */
			if (options.hidePause != undefined)
			{
				this._hidePause = options.hidePause * 1000;
			}
			/* Sub menu opacity */
			if (options.opacity != undefined)
			{
				this._opacity = options.opacity;
			}
		}

		/* Check if the document is already loaded. Prototype 1.6.0 introduces
		 * the document.loaded boolean, for 1.5*, check if we can retrieve an
		 * element from the DOM (fails when document is not loaded).
		 */
		if (document.loaded === true || $(this._menuId))
		{
			this._doInit();
		}
		/* This is how it should work (init called before document load) */
		else
		{
			/* Do the actual initialization on document load. The "dom:loaded"
			 * event is preffered, but only available since 1.6.0 (with
			 * document.observe construction). Fall back to the window onload
			 * when not available.
			 */
			if (document.observe)
			{
				document.observe("dom:loaded", this._doInit.bind(this));
			}
			else
			{
				Element.observe(window, "load", this._doInit.bind(this));
			}
		}
	}, // function init

	/**
	 * Initializes the drop down menu.
	 *
	 * Should be called on page load.
	 */
	_doInit: function()
	{
		/* After the DOM is loaded, save the menu node */
		this._menuNode = $(this._menuId);

		/* Add events to each first level menu node (if any with a submenu). The
		 * Menu._addEvents() method will add events recursively.
		 */
		this._addEvents(this._menuNode);
	}, // function _doInit

	/**
	 * Recursively attaches events to the menu UL.
	 *
	 * @param	HTMLUListElement	ulElement
	 * @param	int					level
	 */
	_addEvents: function(ulElement, level)
	{
		/* If level argument is not given, */
		if (isNaN(level))
		{
			level = 1;
		}

		/* Find all menu nodes */
		var elements = (Element.select) ? ulElement.select("li") : ulElement.getElementsBySelector("li")
		for (var i = 0; i < elements.length; i++)
		{
			/* Only use the direct descendants (we're using recursion) */
			if (elements[i].parentNode == ulElement)
			{
				/* Check if it has a sub menu (should return 1 or zero nodes) */
				var subMenus = (Element.select) ? elements[i].select("ul") : elements[i].getElementsBySelector("ul");
				if (subMenus.length > 0)
				{
					/* Add expand listener to the node */
					elements[i].observe("mouseover", this._showSubMenu.bindAsEventListener(this, elements[i], level));

					/* Add collapse listener to the node if it's the first level
					 * (because the LI contains all other submenu's, therefore
					 * any other listeners are over kill). */
					if (level == 1)
					{
						elements[i].observe("mouseout", this._hideSubMenu.bindAsEventListener(this, elements[i], level));
					}

					/* Add "submenu" class for this node link */
					var a = (Element.select) ? elements[i].select("a")[0] : elements[i].getElementsBySelector("a")[0];
					a.addClassName("submenu");

					/* Recursion: check if the sub menu has nodes as well */
					this._addEvents(subMenus[0], (level + 1));
				}
				/* No sub menu */
				else
				{
					/* Only hide any expanded sub menu when hovering this node */
					elements[i].observe("mouseover", this._quickHideSubMenu.bindAsEventListener(this, elements[i], level));
				}
			}
		}
	}, // function _addEvents

	/**
	 * Shows the sub menu.
	 *
	 * @param	Event	e
	 * @param	int		level
	 */
	_showSubMenu: function(e, obj, level)
	{
		/* Don't bubble up */
		Event.stop(e);

		/* Hide previous opened sub menu */
		this._quickHideSubMenu(e, obj, level);

		/* Get node link and sub menu */
		var a = (Element.select) ? obj.select("a")[0] : obj.getElementsBySelector("a")[0];
		var subMenu = (Element.select) ? obj.select("ul")[0] : obj.getElementsBySelector("ul")[0];

		/* Keep hover style as long as opened */
		a.addClassName("menu_open");

		/* Show sub menu */
		subMenu.setStyle({"visibility": "visible", "position": "absolute"});

		/* Set correct position. (Note: the horizontal/vertical properties only
		 * apply to the first level nodes. All other levels are fixed vertical.
		 */
		var pos = (Element.positionedOffset) ? obj.positionedOffset() : Position.positionedOffset(this);
		if (level == 1 && this._orientation == this.HORIZONTAL)
		{
			subMenu.setStyle({
				"left": pos[0] + "px",
				"top": (pos[1] + obj.getHeight()) + "px"
			});
		}
		else
		{
			subMenu.setStyle({
				"left": (pos[0] + obj.getWidth()) + "px",
				"top": pos[1] + "px"
			});
		}

		/* Apply opacity if not fully opaque. (Apply for sub menu of first level
		 * only, because otherwise opacity would be doubled.)
		 */
		if (level == 1 && this._opacity > 0 && this._opacity < 1)
		{
			subMenu.setOpacity(this._opacity);
		}

		/* Save submenu */
		this._activeNodes.push({"level": level, "link": a, "subMenu": subMenu});
	}, // function _showSubMenu

	/**
	 * Immediately hides the active menu.
	 *
	 * @param	Event	e
	 * @param	int		level
	 */
	_quickHideSubMenu: function(e, obj, level)
	{
		/* Don't bubble up */
		Event.stop(e);

		/* Clear possible timeout */
		if (this._hideTimeout)
		{
			window.clearTimeout(this._hideTimeout);
		}

		/* And hide the open menus from the given level up */
		this._doHideSubMenusFromLevel(level);
	}, // function _quickHideSubMenu

	/**
	 * Method for hiding all sub menus.
	 *
	 * Triggered onmouseout of first sub menu (level 2).
	 *
	 * @param	Event	e
	 * @param	int		level
	 */
	_hideSubMenu: function(e, obj, level)
	{
		/* Don't bubble up */
		Event.stop(e);

		/* No pause? Don't use the timeout */
		if (this._hidePause <= 0)
		{
			/* Hide all sub menus */
			this._doHideSubMenusFromLevel(1);
		}
		else
		{
			/* Hide in x (mili)seconds */
			this._hideTimeout = window.setTimeout(function() { new Menu()._doHideSubMenusFromLevel(1); }, this._hidePause);
		}
	}, // function _hideSubMenu

	/**
	 * Hides all active sub menus from the given level.
	 *
	 * @param	int		level	(Default: 1)
	 *
	 * @return	boolean
	 */
	_doHideSubMenusFromLevel: function(level)
	{
		/* If level argument is not given, default to 1 */
		if (isNaN(level))
		{
			level = 1;
		}

		/* Remove these sub menus from the array */
		this._activeNodes.reject(function(node)
		{
			/* Hide all sub menus with a level equal or higher than the given
			 * level, and return false to remove these from the array.
			 */
			if (node.level >= level)
			{
				/* Remove hover style */
				if (node.link)
				{
					node.link.removeClassName("menu_open");
				}
				/* Hide sub menu */
				if (node.subMenu)
				{
					node.subMenu.setStyle({"visibility": "hidden"});
				}
				/* Return false to remove node from the array */
				return false;
			}
			/* Return true for the other nodes, keeping them in the array */
			return true;
		});
	} // function _doHideSubMenusFromLevel

}); // class Menu
