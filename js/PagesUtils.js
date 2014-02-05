function PagesUtils(sectionUI){
    
    var pageType = sectionUI.attr('class');
    var indexOf = pageType.indexOf('genericSection');
    pageType = (pageType.substring(15, pageType.length));

    var section;
    var features = new Features();
    section = null;
    switch(pageType){
         case PagesUtils.ISOTOPE_PORTFOLIO:
             //home section
             section = new IsotopePortfolio();
             section.init(sectionUI);
         break;
         case PagesUtils.HOME:
            var end = new Date("1/24/2014 15:00");
            var end2 = new Date("2/21/2014 19:00");
            var hour = 60 * 60 * 1000;
            var day = hour * 24;
            var timer;

            function showRemaining() {
                var now = new Date();
                var distance;
                document.getElementById('deadline').innerHTML = 'Regionals Registration Time Left';
                distance = end2.getTime() - now.getTime();
                if (distance < 0) {

                    clearInterval(timer);
                    document.getElementById('days').innerHTML = '00';
                    document.getElementById('hours').innerHTML = '00';

                    return;
                }
                var days = Math.floor(distance / day);
                var hours = Math.floor(distance / hour) - (days * 24);

                document.getElementById('days').innerHTML = checkFormat(days);
                document.getElementById('hours').innerHTML = checkFormat(hours);
            }

            function checkFormat(d){
              if(d<10)
                d = "0"+d;
              return d;
            }

            showRemaining();
         break;
         case PagesUtils.CONTACT:
             //iGallery
             section = new ContactSection();
             section.init(sectionUI);
         break;
         case PagesUtils.BROTHERS:
            var activebro = "none";

            $("a").click(function(){
              var ident = $(this).attr("id");
              if(activebro == "none"){
                $("#" + ident + "info").fadeIn("slow");
                activebro = ident;
              } else if(ident != activebro){
                $(".info").fadeOut();
                $("#" + ident + "info").delay(600).fadeIn("slow");
                activebro = ident;
              } else{
                $(".info").fadeOut();
                activebro = "none";
              }
            });
            
            function setVisBros( fout, fin ){
              $(fout).fadeTo("slow", 0.00, function(){ //fade
                $(this).slideUp("fast");
              });
              $(fin).slideDown("fast", function(){
                $(this).fadeTo("slow", 1.00);
              });
            }
            
            $(function() {
              $("#alum").click(function() {
                setVisBros(".act",".alum");
              });
            });
            
            $(function() {
              $("#act").click(function() {
                setVisBros(".alum",".act");
              });
            });
              
            $("#all").click(function(){
              $(".alum").fadeTo("slow", 1.00);
              $(".act").fadeTo("slow", 1.00);
            });
         break;
         case PagesUtils.REGIONALS:
            $(".pagesBackground").css("opacity", "0.75");
            var WePay = WePay || {};WePay.load_widgets = WePay.load_widgets || function() { };WePay.widgets = WePay.widgets || [];WePay.widgets.push( {object_id: 169603,widget_type: "event",anchor_id: "wepay_widget_anchor_528f251d96351",widget_options: {reference_id: ""}});if (!WePay.script) {WePay.script = document.createElement('script');WePay.script.type = 'text/javascript';WePay.script.async = true;WePay.script.src = 'https://static.wepay.com/min/js/widgets.v2.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(WePay.script, s);} else if (WePay.load_widgets) {WePay.load_widgets();}
         break;
         case PagesUtils.GALLERY:
            $(function(){
              //INITALIZE THE PLUGIN
              $('#grid').grid({
                    imagesOrder: 'byName', //byDate, byDateReverse, byName, byNameReverse, random
                    albumsOrder: 'byName', //byDate, byDateReverse, byName, byNameReverse, random, none
                    folderCoverRandom: true, //If there is no folderCover image then get a random image
                    foldersAtTop: true, //If you want the folders to be always first and then the images
                    showNumFolder: true, //If you want to show the number of folders inside a folder
                    showNumImages: true, //If you want to show the number of images inside a folder
                    autoHideNumFolder: true, //If there is no folders inside a folder then don't show the number of folders
                    autoHideNumImages: false, //If there is no images inside a folder then don't show the number of images
                    isFitWidth: true, //Nedded to be true if you wish to center the gallery to its container
                    lazyLoad: true, //If you wish to load more images when it reach the bottom of the page
                    showNavBar: true, //Show the navigation bar?
                    imagesToLoadStart: 15, //The number of images to load when it first loads the grid
                    imagesToLoad: 5, //The number of images to load when you click the load more button
                    horizontalSpaceBetweenThumbnails: 5, //The space between images horizontally
                    verticalSpaceBetweenThumbnails: 5, //The space between images vertically
                    columnWidth: 'auto', //The width of each columns, if you set it to 'auto' it will use the columns instead
                    columns: 5, //The number of columns when you set columnWidth to 'auto'
                    columnMinWidth: 195, //The minimum width of each columns when you set columnWidth to 'auto'
                    isAnimated: true, //Animation when resizing or filtering with the nav bar
                    caption: false, //Show the caption in mouse over
                    captionType: 'grid', // 'grid', 'grid-fade', 'classic' the type of caption effect
                    lightBox: true, //Do you want the lightbox?
                    lightboxKeyboardNav: true, //Keyboard navigation of the next and prev image
                    lightBoxSpeedFx: 500, //The speed of the lightbox effects
                    lightBoxZoomAnim: true, //Do you want the zoom effect of the images in the lightbox?
                    lightBoxText: true, //If you wish to show the text in the lightbox
                    lightboxPlayBtn: true, //Show the play button?
                    lightBoxAutoPlay: false, //The first time you open the lightbox it start playing the images
                    lightBoxPlayInterval: 4000, //The interval in the auto play mode 
                    lightBoxShowTimer: true, //If you wish to show the timer in auto play mode
                    lightBoxStopPlayOnClose: false, //Stop the auto play mode when you close the lightbox?
                    hashTag: false, //Change the HasTag each time you navigate through albums (so you can share a single album)
              });
            });
            $("h4").css('color','white');
         break;                                                                                                      
         case PagesUtils.FAMILY:
            $("li").css("list-style","none");
            $("ul .fam").css('font-size','100%');
            $(".accordion").accordion({ active:false, collapsible:true, heightStyle:"content" });
            $(".accordionsub").accordion({ collapsible:true, heightStyle:"content" });
            $(".fam li").css("background","url(/images/accordion/arrow.png) no-repeat left center");
            $(".fam li").css("padding","5px 16px");
         break;
    }
}

PagesUtils.ISOTOPE_PORTFOLIO = 'section-ISOTOPE-PORTFOLIO';
PagesUtils.HOME = 'section-HOME';
PagesUtils.CONTACT = 'section-CONTACT';
PagesUtils.BROTHERS = 'section-BROTHERS';
PagesUtils.REGIONALS = 'section-REGIONALS';
PagesUtils.GALLERY = 'section-GALLERY';
PagesUtils.FAMILY = 'section-FAMILY';