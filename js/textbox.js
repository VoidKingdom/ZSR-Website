/*A function which gets the info from the editable span and puts it into the text area before it gets processed. left vague so it can be used on multiple pages */
function getContent(){
    document.getElementById("hidden-textarea").value = document.getElementById("shown-textbox").innerHTML;
}