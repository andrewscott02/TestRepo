//#region Basics Course (jQuery Basics - https://teamtreehouse.com/library/jquery-basics-2)

//#region Basics - Introducing jQuery

//#region Basics - Selecting Objects and Basic Events

jQuery(".box"); //Can use this to select elements instead of query selectors or getting elements
$(".box"); //Shorthand: Use $ instead of typing jQuery

$(".box").hide(); //Sets the display to none
$(".box").show(); //Sets the display back to default

$(".box").click(()=>{
    //Code here for when the element is clicked
})

$('#price-list li'); //Can select elements and their children, much like CSS

//#endregion

//#region Basics - Animating Elements with jQuery

//Anims play one after another
$("#headline").hide(); //Hides at start
$("#headline").fadeIn(1000); //Fades in for 1 second (1000 mileseconds)
$("#headline").delay(3000); //Waits 3 seconds
$("#headline").slideUp(1000); //Slides up

//Can also chain like this
$("#headline").hide().slideDown(1000).delay(3000).slideUp();

//Or like this
$("#headline")
    .hide()
    .slideDown(1000)
    .delay(3000)
    .slideUp();

//#endregion

//#region Basics - Changing Content

$("#headline").text(); //Gets the content
$("#headline").text("New Text Content"); //Sets the content

//This is plain text, so tags like strong will not work
$("#headline").text("<strong>New</strong> Text Content");
//We need to use the html method instead
$("#headline").html("<strong>New</strong> Text Content");

//#endregion

//#region Basics - Getting Values from Form Fields

$("#previewButton").click(()=>{
    const title = $("#blogTitleInput").val();
    const content = $("#blogContentInput").val();

    $("#headline").html("<strong>New</strong> Post");
    $("#content").html("Text Content");
});

//#endregion

//#endregion

//#region Basics - Understanding jQuery Events and DOM Traversal

//#region Basics - Adding jQuery to a Project

/**
 * Download jQuery Source File: https://jquery.com/download/
 * Add jQuery source file and inlclude in the js folder
 * Add file before other javascript files are loaded so they can use it
*/

/**
 * Using jQuery with a CDN, no downloads required: https://releases.jquery.com/
 * Copy script code, suggested to use minified version
*/

//#endregion

//#region Basics - Unobtrusive Javascript Principles

/**
 * Seperated from HTML and CSS
 * Cross browser consistency
 * Progressive Enhancement - Core content and functionality works even if javascript is disabled
 */

//This means that elements that require java should be generated with java (not included in the HTML) if they cannot be used without

//Creating elements with jQuery
const $button = $("<button>RevealSpoiler</button>");
$(".spoiler").append($button); //Adds item at the end
$(".spoiler").prepend($button); //Adds item at the start

//#endregion

//#region Basics - Using on() for Event Handling

$(".element").on("click keypress", ()=>{
    //Code calls when element is clicked or a key is pressed
})

//#endregion

//#region Basics - Using Events with Dynamically Added Events

$(".element").on("click", "button", ()=>{
    $(".element button").hide(); //Hides all buttons when a button child is clicked
})

//Use event object if multiple buttons are present
$(".element").on("click", "button", (event)=>{
    $(event.target).hide(); //Hides single button when the button child is clicked
})

//Can also use this to specify single button
$(".element").on("click", "button", ()=>{
    $(this.target).hide(); //Hides single button when the button child is clicked
})

//#endregion

//#region Basics - Traversing the DOM with jQuery

$("li").eq(1); //Selects the list item with an index of 1 (second list item)
$("li").eq(1).css({color: "green"}); //Changes the text colour to green

$("li").eq(-2); //Loops back to the end of the list to select the second to last item

//These do not cause errors, but will not loop around
$("li").eq(1).prev(); //Selects the second list item, then selects the previous list item
$("li").eq(1).next(); //Selects the second list item, then selects the next list item

//#endregion 

//#endregion

//#region Basics - Working with jQuery Collections

//#region Basics - Selectors

/**
 * CSS Selectors
 * -Tags: h1, p, a
 * -ID: #footer
 * -Classes: .profile-image
 * -Pseudoclasses: :first, :last
 */

/**
 * jQuery Selectors
 * :radio, :checkbox, :password
 * :odd, :even
 * :visible, :hidden
 */

const $odd = $("a:odd"); //Selects all anchor tags with an odd index
const $secureLinks = $(`a[href^="https://"]`); //Selects all anchor tags that start with https://
const $pdfs = $(`a[href$=".pdf"]`); //Selects all anchor tags that ends with .pdf

//#endregion

//#region Basics - Adding Attributes

$secureLinks.attr("target"); //Gets the target attribute
$secureLinks.attr("target", "_blank"); //Sets the target attribute to blank (opens in new tab)
$secureLinks.attr("download", "true"); //Sets the download attribute to true, so it downloads instead of opening in browser

//#endregion

//#region Basics - Changing Element Styles and Classes

$(".element").css("backgroundColor", "green"); //Directly modify css styles

//Adds or removes classes from the elements, remember to not include the . before the class name here in the class to add
$(".element").addClass("class-to-add");
$(".element").removeClass("class-to-remove");
$(".element").toggleClass("class-to-toggle");

//#endregion

//#region Basics - Stopping Browser's Default Behaviour

//event.preventDefault(); //Prevents default behaviour
//Useful to prevent automatically opening links or submitting forms and reloading the page

$pdfs.on("click", (event)=>{
    if ($(":checked").length === 0) //If no checkboxes are checked
    {
        event.preventDefault(); //Prevents default behaviour
        alert("Please allow PDF downloads");
    }
})

//#endregion

//#region Basics - Looping through jQuery Collections

$("a").each(()=>{
    //Loops through all items with an a tag
})

$("a").each((index, element)=>{
    //Loops through all items with an a tag
    //index: optional, index of the item as it appears
    //index: optional, reference to the element (could rename to item)
    console.log(`${index}: ${element}`);
})

$("a").each((element)=>{
    const url = $(element).attr("href");
    $(element).parent().append(`(${url})`) //Appends the url text after previous element to show it
})

$("a").each(()=>{
    //Can use this in place of element
    const url = $(this).attr("href");
    $(this).parent().append(`(${url})`) //Appends the url text after previous element to show it
})

//#endregion

//#endregion

//#endregion

//#region Plugins Course (Using jQuery Plugins - https://teamtreehouse.com/library/using-jquery-plugins)

//#region Plugins - Introducing jQuery Plugins

//#region Plugins - Useful Plugins

/**
 * Open dialogue boxes for form fields, buttons and content for other pages
 * jQuery Adaptive Modal - http://www.thepetedesign.com/demos/adaptive-modal_demo.html
 * 
 * If you have a list with a lot of items, you can use ListNav
 * to help navigate through them
 * jQuery ListNav - http://ericsteinborn.com/jquery-listnav
 * 
 * Add video backgrounds with vide
 * Vide - http://vodkabears.github.io/vide/
 * 
 * Show image and galleries with Lightbox 2
 * Lightbox 2 - http://lokeshdhakar.com/projects/lightbox2/
 * 
 * Framework for various features, including datepickers, drag and drop and others
 * jQuery UI - https://jqueryui.com/
*/

//#endregion

//#endregion

//#region Plugins - Add a Sticky Navigation Bar

//#endregion

//#region Plugins - Using a jQuery Carousel

//#endregion

//#endregion