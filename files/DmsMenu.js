var dmsMenuDisplayedId = -1;
var dmsMenuType = ''; // 'community', 'taxonomy', ''
var dmsDynamicContentBox = true;
var dmsEktControlID = '';
var dmsMenuAppPath = '';

/* This function is called by menu items that need to perform server-side */
/* logic, which the content page needs to refesh to see.  For example, */
/* "Check-in" executes an ajax request to check-in the content item, then */
/* needs to refresh the page to show the state of the content has changed from "O" to "I" */
function refreshPage()
{
	setTimeout(function()
		{
			self.location.href=self.location;
		}, 1000);
}

/* This fucntion is called by the onclick event of the folder item's paragraph element */
function dmsMenuShowMenu(id, languageId, menuGuid, dmsCommunityDocumentsMenu, menuSubtype)
{
    dmsMenuType = dmsCommunityDocumentsMenu;

	if ((dmsMenuDisplayedId === id && $ektron(dmsWrapper).length > 0) || (dmsMenuDisplayedId !== -1))
	{
		dmsMenuDestroyMenu(id, languageId, menuGuid, true);
		if (dmsMenuDisplayedId !== -1)
		{
			dmsMenuFetch(id, languageId, menuGuid, menuSubtype);
		}
		dmsMenuDisplayedId = -1;
	}
	else
	{
		dmsMenuFetch(id, languageId, menuGuid, menuSubtype);
		dmsMenuDisplayedId = String(id) + String(languageId) + String(menuGuid);
	}
}

/* This function fetches the menu from the CMS via Ajax */
function dmsMenuFetch(id, languageId, menuGuid, menuSubtype)
{
    /* Show the "LOADING" div while the menu is being fetched */
    var dmsWrapperId = "#dmsWrapper" + String(id) + String(languageId) + String(menuGuid);
    var dmsWrapper = $ektron(dmsWrapperId);
    $ektron(dmsWrapperId + " p.dmsItemWrapper").addClass("dmsItemWrapperLoading");

    //OLD STUFF
    /*var dmsLoadingMessage = $ektron("#dmsMenuLoading");
    if (dmsLoadingMessage) { $ektron("#dmsLoadingMessage").css("display","block"); }
    */

	/* Get the menu wrapper */
	var dmsWrapper = $ektron("#dmsWrapper" + String(id) + String(languageId) + String(menuGuid));

	/* If the browser is IE, then we can create a menu specific to IE (opens Office assets directly in Office */
	/* See functions "editMSOfficeFile()" and viewMSOfficeFile() below */
	var ieMenu = "false";
	if ($ektron.browser.msie)
	{
		/* Only set "ieMenu" to true if office is installed */
		/* ShowMultipleUpload() tests to see if Offic is installed and exists in Workarea/java/determineoffice.js */
		if (typeof ShowMultipleUpload != 'undefined' && ShowMultipleUpload())
		{ieMenu = "true";}
	}
	var taxonomyOverrideId = 0;
	if (dmsMenuType != '')
	{
	    if ($ektron("#taxonomyselectedtree").length > 0)
	    {
	        taxonomyOverrideId = $ektron("#taxonomyselectedtree").attr("value");
	    }
	}

	/* Use JQuery to fetch the menu via Ajax */
	// fix for bug #40489
    var dmsMenuClientId = dmsWrapper.find("input[type='hidden'][class='dmsItemClientId']");
    if (dmsMenuClientId.length > 0)
    {
        // this is a control using the DMS menu, and we need that control's ClientId for AJAX responses
        dmsMenuClientId = dmsMenuClientId.val().replace(/\$/g, "_");
    }
    else
    {
        // otherwise, use the default dmsEktControlID value
        dmsMenuClientId = dmsEktControlID;

    }
    $ektron.get(dmsMenuAppPath + "DmsMenu/DmsMenu.aspx", { contentId: id, createIeSpecificMenu: ieMenu,
            communityDocuments:dmsMenuType, dynamicContentBox:dmsDynamicContentBox,
            dmsEktControlID:dmsMenuClientId, dmsLanguageId:languageId,
            taxonomyOverrideId:taxonomyOverrideId, dmsMenuGuid: menuGuid, dmsMenuSubtype: menuSubtype},
        function(data){
            try
            {
                var notLoggedInCheck = data.indexOf("-1|");
                if (notLoggedInCheck != -1)
                {
                    //user's not logged-in, alert user to log in.
                    alert(String(data).replace("-1|",""));
                }
                else
                {
                    //user's logged-in - process data
			        //set the innerHTML of the paragraph element to the AJAX response
			        /* Insert the Ajax response into the dms wrapper */
			        var dmsWrapperId = "#dmsWrapper" + String(id) + String(languageId) + String(menuGuid);
                    $ektron(data).appendTo(dmsWrapperId);

	                var dmsMenuWrapper = $ektron("#dmsMenuWrapper" + String(id) + String(languageId) + String(menuGuid));
	                dmsMenuWrapper.css("visibility", "hidden");
			        dmsMenuWrapper.css("display", "block");

			        var dmsMenuWrapperWidth = document.getElementById("dmsMenuWrapper" + String(id) + String(languageId) + String(menuGuid)).offsetWidth;
			        var dmsItemWrapper = $ektron("#dmsItemWrapper" + String(id) + String(languageId) + String(menuGuid));
			        var dmsItemWrapperWidth = document.getElementById("dmsItemWrapper" + String(id) + String(languageId) + String(menuGuid)).offsetWidth;

                    var borderWidth=0;
                    var dmsItemWrapper = $ektron("#dmsItemWrapper" + String(id) + String(languageId) + String(menuGuid));
                    if ($ektron.browser.msie)
                    {
                        switch(dmsItemWrapper.css("border-width"))
                        {
                            case "0px":
                                borderWidth = 1;
                                break;
                            case "medium":
                                borderWidth = 2;
                                break;
                            default:
                                borderWidth = 0;
                                break
                        }
                    }
                    if ($ektron.browser.mozilla)
                    {
                        if (dmsItemWrapper.css("border-right-width") !== "0px")
                        { borderWidth = 0; }
                        else
                        { borderWidth = 2;}
                    }
                    if ($ektron.browser.safari)
                    {
                        if (dmsItemWrapper.css("border-right-width") !== "0px")
                        { borderWidth = 0; }
                        else
                        { borderWidth = 2;}
                        /* eliminate the 1px top margin to ensure menu renders flush with dmsItemWrapper */
                        dmsMenuWrapper.css("margin-top", "-2px !important");
                    }

			        if (dmsMenuWrapperWidth > dmsItemWrapperWidth)
			        { leftMargin = "20px"; }
			        else
			        { leftMargin = (dmsItemWrapperWidth - dmsMenuWrapperWidth + borderWidth) + "px"; }

                    //remove loading gif
                    $ektron(dmsWrapperId).removeClass("dmsItemWrapperLoading");

                    //set <p> to active
                    $ektron(dmsItemWrapper).attr("class", "dmsItemWrapperActive");
			        $ektron(dmsItemWrapper).attr("title", "Hide Menu");

			        //show the correctly positioned menu
			        $ektron(dmsMenuWrapper).css("margin-left", leftMargin);
			        $ektron(dmsMenuWrapper).css("display", "");
			        $ektron(dmsMenuWrapper).css("visibility", "visible");
			    }
			}
			finally
			{
			    /* Hide loading message */
                $ektron("#dmsLoadingMessage").css("display","none");
            }
        });
}

/* Begin IE6-specific handling */

var dmsMenuAddIE6HoverOnRefreshCounter = 0;
var dmsMenuAddIE6HoverOnRefreshIntervalId = 0;

setTimeout(function() {
	if ($ektron.browser.msie && $ektron.browser.version < 7) {
		$ektron("div.dmsWrapper").ready(function(){
			dmsMenuAddIE6HoverOnRefreshCounter = 1;
			dmsMenuAddIE6HoverOnRefreshIntervalId = setInterval("dmsMenuAddIE6HoverOnRefresh()", 500);
		});
	}
},1000);

function dmsMenuAddIE6HoverOnRefresh()
{
    if (dmsMenuAddIE6HoverOnRefreshCounter < 10)
    {
        $ektron("div.dmsWrapper").hover(
            function() {
                $ektron(this).attr("class", "dmsWrapperIE6Hover");
            },
            function() {
                $ektron(this).attr("class", "dmsWrapper");
            }
        );
        dmsMenuAddIE6HoverOnRefreshCounter++;
    }
    else
    {
        clearInterval(dmsMenuAddIE6HoverOnRefreshIntervalId);
    }
}

function dmsMenuAddIE6Hover(id)
{
    setTimeout(function()
    {
        var dmsWrapper = $ektron("#" + id);
        $ektron(dmsWrapper).hover(
            function() {
                $ektron(dmsWrapper).attr("class", "dmsWrapperIE6Hover");
            },
            function() {
                $ektron(dmsWrapper).attr("class", "dmsWrapper");
            }
        );
    },1000);
}

/* End IE-specific handling */

/* This function destroys the menu object the previously selected menu */
function dmsMenuDestroyMenu(id, languageId, menuGuid, forceMenuClose)
{
    if (dmsMenuDisplayedId != (String(id) + String(languageId) + String(menuGuid)) || forceMenuClose === true)
    {
        /* Use Jquery to remove any Dms Menus */
        var activeDmsMenus = $ektron('.dmsMenuWrapper');
        for (i=0; i < activeDmsMenus.length; i++)
        {
            $ektron(activeDmsMenus[i]).remove();
        }
        /* Use Jquery to reset any active Item Wrappers to inactive */
        var activeDmsItemWrappers = $ektron('.dmsItemWrapperActive');
        for (i=0; i < activeDmsItemWrappers.length; i++)
        {
           activeDmsItemWrappers[i].className = 'dmsItemWrapper';
           activeDmsItemWrappers[i].title = 'View Menu';
        }

        /* Since the menu's been destroyed, set the global var dmsMenuDisplayedId to -1 */
        dmsMenuDisplayedId = -1;
    }
}

/* This funtion opens Office documents in IE only */
function editMSOfficeFile(checkOutUrl, fileName)
{
    if($ektron.browser.msie)
    {
        /* Show the "LOADING" div while the menu is being fetched */
        var dmsLoadingMessage = document.getElementById("dmsMenuLoading");
        if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "block"; }

	    try
	    {
            /* Use Jquery to execute content-state action via ajax */
            $ektron.get(checkOutUrl,
                function(data, status)
                {
                    if (status === "success")
                    {
                        /* attempt to change content state */
                        try
                        {
		                    /* if ajax call was successful, open office with document */
		                    try
                            {
                                var obj = new ActiveXObject('SharePoint.OpenDocuments.2');
                                obj.EditDocument2(window,fileName, '');
                            }
                            catch(e)
                            {
                                try
                                {
                                    obj = new ActiveXObject('SharePoint.OpenDocuments.3');
                                    obj.EditDocument3(window,fileName, '');
                                }
                                catch(e)
                                {
                                    obj = new ActiveXObject('SharePoint.OpenDocuments.1');
                                    obj.EditDocument(window,fileName, '');
                                }
                            }

                            //31312 - edit in office does not work first time after install
                            refreshPage();
                            /* prevent href from firing - ajax attempt was ok */
		                }
		                catch(e)
		                {
		                    /* active X instantiation failed, attempt to peform the same action via href (non-ajax) */
		                    window.location = checkOutUrl + "&executeActiveX=true";
		                }
		                finally
		                {
		                    /* Hide loading message */
                            if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "none"; }
                        }
                    }
                    else
                    {
                        /* ajax request failed, attempt to peform the same action via href (non-ajax) */
		                window.location = checkOutUrl + "&executeActiveX=true";
                    }
            });

            //refreshPage();
            return false;
        }
        catch(e)
        {
            //alert(e.description);
            return true;
        }
    }
}

/* This funtion executes a number of menu actions - mainly for actions that require content state change. */
/* Specifically, this fucntion is called by the following menu items: */
/* Approve, CheckIn, Decline, Delete, Publish, Submit */
function dmsMenuAction(href)
{
     /* Show the "LOADING" div while the menu is being fetched */
    var dmsLoadingMessage = document.getElementById("dmsMenuLoading");
    if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "block"; }

    try
    {
        /* Use Jquery to execute content-state action via ajax */
        $ektron.get(href,
            function(data, status)
            {
                if (status === "success")
                {
                    /* content state change succeeded, refresh page to show change in state */
                    refreshPage();
                }
                else
                {
                    alert("failed!");
                    /* ajax request failed, attempt to peform the same action via href (non-ajax) */
	                window.location = href;
                }
				/* Hide loading message */
                if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "none"; }
        });
        return false;
    }
    catch(e)
    {
        //the ajax request failed, return true so that the browser attempts to perform the action via href.
        return true;
    }
    finally
    {
        /* Hide loading message */
        if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "none"; }
    }
}

/* This function does the same thing as dmsMenuAction, but it opens a success/failure */
/* window to show indicate to the user if the request was succesfully sent or not */
function dmsMenuRequestCheckIn(href)
{
     /* Show the "LOADING" div while the menu is being fetched */
    var dmsLoadingMessage = document.getElementById("dmsMenuLoading");
    if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "block"; }

    try
    {
        /* Use Jquery to execute content-state action via ajax */
        $ektron.get(href,
            function(data, status)
            {
                //show response - success/failure
                alert(data);
				/* Hide loading message */
                if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "none"; }
        });
        return false;
    }
    catch(e)
    {
        //the ajax request failed, return true so that the browser attempts to perform the action via href.
        return true;
    }
    finally
    {
        /* Hide loading message */
        if (dmsLoadingMessage) { dmsLoadingMessage.style.display = "none"; }
    }
}

function dmsForceCheckIn(href, message)
{
    var confirmation=confirm(message);
    if (confirmation)
    {
        dmsMenuAction(href);
    }
}

function viewMSOfficeFile(fileName)
{
    if($ektron.browser.msie)
    {
        var obj = new ActiveXObject('SharePoint.OpenDocuments.2');
        obj.ViewDocument2(window,fileName, '');
		return false;
    }
}

function dmsMenuConfirmDelete(str)
{
    var confirmation = confirm(str);
    if (confirmation === true)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function dmsModifyImage(href, idThumb)
{
     /* show AJAX image busy icon */
    var imgtag = document.getElementById(idThumb);
    if (imgtag == null) {
        alert('error: missing ID for thumbnail image in ekml template');
        return false; // no thumbnail so ignore command
    }
    var oldimg = imgtag.src;
    imgtag.src = dmsMenuAppPath + '/images/application/DMSMenu/dmsMenuAjaxLoading.gif';

    try
    {
        /* Use Jquery to execute content-state action via ajax */
        $ektron.get(href,
            function(data, status)
            {
                if (status === "success")
                {
                    // anything special to do?
                }
                else
                {
                    /* ajax request failed, attempt to peform the same action via href (non-ajax) */
	                window.location = href;
                }
				
				var qsObj = {};
				var newQueryString = "";
				var re = new RegExp("([?|&])r=.*?(&|$)","i");
				var bigimgtag = document.getElementById(idThumb.replace(/GalleryThumb/,"PhotoGallery"));
				var bigImgHref = bigimgtag.href;
				                    
				oldimg.replace(new RegExp( "([^?=&]+)(=([^&]*))?", "g" ), 
                    function( $0, $1, $2, $3 )
                    {
                        qsObj[$1] = $3;
                    }
                );
                if (qsObj["r"])
                {
                    if (oldimg.match(re))
                    {
                        oldimg =  oldimg.replace(re,'$1' + "r" + "=" + Math.random() + '$2');
                    }
                    else
                    {
                        oldimg =  oldimg + "&r=" + Math.random();
                    }
                    if (oldimg.match(re))
                    {
                        bigImgHref =  bigImgHref.replace(re,'$1' + "r" + "=" + Math.random() + '$2');
                    }
                    else
                    {
                        bigImgHref =  bigImgHref + "&r=" + Math.random();
                    }
                }
                else
                {
                    oldimg += "?r=" + Math.random();
                    bigImgHref += "?r=" + Math.random();
                }
                /* refresh thumbnail */
                imgtag.src = oldimg;
                // switch over view image as well
                
		        bigimgtag.href = bigImgHref;	// replace preloaded image
        });
        return false;
    }
    catch(e)
    {
        imgtag.src = oldimg;
        //the ajax request failed, return true so that the browser attempts to perform the action via href.
        return true;
    }
}

// begin Sync modifications
if (Ektron.DMSMenu === undefined)
{
    Ektron.DMSMenu =
    {
        Sync: function(settings)
        {
            /*  possible settings parameters
                contentLanguage: indicates the content language for this content
                contentId: the id of the cotnent item
                contentAssetId: the content asset id number (if applicable)
                contentAssetVersion: the content asset version number (if applicable)
                folderId: the parent folder id  number
                dmsSyncPath: the full path to the dmsSync.aspx necessary when the modals are not present
            */
            var s = settings;
            // check for the presence of the necessary SyncConfigModal
            if ($ektron("#ShowSyncConfigModal").length > 0)
            {
                // the modal is present, so we can do the sync in this window
                Ektron.Sync.checkMultipleConfigs(s.contentLanguage, s.contentId, s.contentAssetId, s.contentAssetVersion, s.folderId, s.isMultisite);
            }
            else
            {
                // popup a new window to perform the sync
                dmsSyncWindow = window.open(s.dmsSyncPath + '?contentLanguage=' + s.contentLanguage + '&contentId=' + s.contentId + '&contentAssetId=' + s.contentAssetId + '&contentAssetVersion=' + s.contentAssetVersion + '&folderId=' + s.folderId + '&isMultiSite=' + s.isMultisite, 'dmsSync', 'resizable=no,scrollbars=no,toolbar=no,status=no,menubar=no,location=no,height=1,width=1');
                dmsSyncWindow.focus();
            }
            //return false to prevent click through
            return false;
        }
    };
}