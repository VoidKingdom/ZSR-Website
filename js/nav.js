/*Initialisation of the mNav tag */
let mNav = false;

/*Toggle the nav to open and close the mobile nav */
function toggleNav() {
    if (mNav === false) {
        document.querySelector(".mobilenav").style.height = "100vh";
        mNav = true;
    } else if (mNav === true) {
        document.querySelector(".mobilenav").style.height = "0";
        mNav = false;
    }
}

/*This function allows me to change the nav dependant on wind size to maintain responsiveness. If the mobile menu is open and you change window size it also closes it if you toggle between the menu varitions */
function changeNav() {
    if (window.innerWidth >= 600) {
        document.querySelector(".open").style.display = "none";
        document.querySelector(".mobilenav").style.height = "0";
        mNav = false;

    } else {
        document.querySelector(".open").style.display = "block";
    }
}

/*Ran once so the inital layout is appropiately applied because the event listener does not work on startup */
changeNav();
/*anytime the window size is change, it check the size to see if menu style needs to change*/
window.addEventListener("resize", changeNav);

