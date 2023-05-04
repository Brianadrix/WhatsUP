// Author: fiVe
// Description: JavaScript for SearchPage

import { NavBarSectionDivider } from "./classes/NavBarSectionDivider.js";
import { FeedGenerator } from "./classes/FeedGenerator.js";
import { PostThreadDataDriver } from "./classes/PostThreadDataDriver.js";
import { NavBarFactory } from "./classes/NavBarFactory.js";

// TEST DATA
import postsJSON from "../test/posts.json" assert { type: 'json' };
import profileJSON from "../test/searchProfile.json" assert { type: 'json' };

class SearchPage {

    constructor() {
        // GLOBAL VARIABLE
        this.mapAPI = new GeneratePostMap();

        this.initializeNavBar();
        this.navBarSectionDividerImplementation();
        this.initializeFeedGenerator();       
    }

    initializeNavBar() {
        new NavBarFactory("type1", "visitor");
    }

    navBarSectionDividerImplementation() {
        const links       = document.querySelectorAll('.nav-item a'),
              ALL_DIV     = "all",
              POSTS_DIV   = "posts",
              PROFILE_DIV = "profile",
              CARD_DIVS   = ["posts", "profile"];

        let nbsd = new NavBarSectionDivider(links, CARD_DIVS);

        document.getElementById("all-button").onclick = function() {
            nbsd.changeDiv(ALL_DIV);
        }
        document.getElementById("posts-button").onclick = function() {
            nbsd.changeDiv(POSTS_DIV);
        }
        document.getElementById("profile-button").onclick = function() {
            nbsd.changeDiv(PROFILE_DIV);
        }
    }

    initializeFeedGenerator() {
        let feedGenerator = new FeedGenerator(this.mapAPI);
        
        feedGenerator.initializeSideNavBar();
        feedGenerator.generateDefaultPostThread(postsJSON);
        feedGenerator.generateProfile(profileJSON);

        new PostThreadDataDriver(feedGenerator.getHasThreadsArray());
    }

}

// DRIVER [PLEASE DO NOT MODFIY]
new SearchPage();