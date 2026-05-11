<template>
    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper">
        <div class="brand-logo">
            <router-link
                :to="{ name: `adminDashboard` }"
                class="d-flex align-items-center"
            >
                <img
                    :src="`${get_setting_value('image') ?? 'avatar.png'} `"
                    class="logo-icon"
                    alt="logo icon"
                />
                <h5 class="logo-text">Super Admin Panel</h5>
            </router-link>
            <div class="close-btn">
                <i class="zmdi zmdi-close" @click="toggle_menu"></i>
            </div>
        </div>

        <div class="text-center mt-3">
            <img
                class="rounded-circle p-1"
                height="70"
                width="70"
                :src="`${auth_info.image ?? 'avatar.png'}`"
                alt=""
            />
            <p class="mt-2">Mr. {{ auth_info.name }}</p>
        </div>
        <hr />
        <ul class="metismenu" id="menu">
            <!-- <li class="menu-label">Management</li> -->
            <!-- <li>
        <router-link :to="{ name: `adminDashboard` }" class="border" href="javascript:void();">
          <div class="parent-icon">
            <i class="zmdi zmdi-view-dashboard"></i>
          </div>
          <div class="menu-title">Dashboard</div>
        </router-link>
      </li> -->
            <side-bar-single-menu
                :icon="`zmdi zmdi-view-dashboard`"
                :menu_title="`Dashboard`"
                :route_name="`adminDashboard`"
            />
            <!-- Management start -->
            <side-bar-drop-down-menus
                :icon="`fa-solid fa-users`"
                :menu_title="`User Management`"
                :menus="[
                    {
                        route_name: `AllUser`,
                        title: `Users`,
                        icon: `zmdi zmdi-account`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-chalkboard-user`"
                :menu_title="`Live Course`"
                :menus="[
                    {
                        route_name: `AllLiveCourse`,
                        title: `Live Courses`,
                        icon: `zmdi zmdi-tv-play`,
                    },
                    {
                        route_name: `AllLiveCourseBatch`,
                        title: `Batches`,
                        icon: `zmdi zmdi-group`,
                    },
                    {
                        route_name: `AllLiveCourseEnrollment`,
                        title: `Enrollments`,
                        icon: `zmdi zmdi-assignment-check`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-video`"
                :menu_title="`Recorded Course`"
                :menus="[
                    {
                        route_name: `AllCourseCategory`,
                        title: `Course Category`,
                        icon: `zmdi zmdi-folder`,
                    },
                    {
                        route_name: `AllCourses`,
                        title: `All Courses`,
                        icon: `zmdi zmdi-library`,
                    },
                    {
                        route_name: `AllCourseInstructors`,
                        title: `Instructors`,
                        icon: `zmdi zmdi-account-o`,
                    },
                    {
                        route_name: `AllEnrollInformation`,
                        title: `Enrollments`,
                        icon: `zmdi zmdi-assignment-check`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-clipboard-question`"
                :menu_title="`Quiz Management`"
                :menus="[
                    {
                        route_name: `AllQuizQuestionTopic`,
                        title: `Quiz Topics`,
                        icon: `zmdi zmdi-label`,
                    },
                    {
                        route_name: `AllQuizQuestion`,
                        title: `Questions`,
                        icon: `zmdi zmdi-help`,
                    },
                    {
                        route_name: `AllQuiz`,
                        title: `All Quiz`,
                        icon: `zmdi zmdi-assignment`,
                    },
                    {
                        route_name: `AllQuizSubmissionResult`,
                        title: `Submission Results`,
                        icon: `zmdi zmdi-chart`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-globe`"
                :menu_title="`Website Management`"
                :menus="[
                    {
                        route_name: `AllWebsiteBanner`,
                        title: `Banner`,
                        icon: `zmdi zmdi-image`,
                    },
                    {
                        route_name: `AllSubBanner`,
                        title: `Sub Banner`,
                        icon: `zmdi zmdi-photo`,
                    },
                    {
                        route_name: `AllAtAGlance`,
                        title: `At a Glance`,
                        icon: `zmdi zmdi-chart`,
                    },
                    {
                        route_name: `CreateWhyUs`,
                        title: `Why Us`,
                        icon: `zmdi zmdi-star`,
                    },
                    {
                        route_name: `AllOurService`,
                        title: `Our Service`,
                        icon: `zmdi zmdi-wrench`,
                    },
                    {
                        route_name: `AllOurSpeciality`,
                        title: `Our Speciality`,
                        icon: `zmdi zmdi-badge`,
                    },
                    {
                        route: {
                            name: `EditOurTrainer`,
                            params: { id: 'our-trainers' },
                        },
                        title: `Our Trainer`,
                        icon: `zmdi zmdi-account-o`,
                    },
                    {
                        route_name: `AllWebsiteBrand`,
                        title: `Brands`,
                        icon: `zmdi zmdi-badge-check`,
                    },
                    {
                        route_name: `AllSuccssStories`,
                        title: `Success Stories`,
                        icon: `zmdi zmdi-star-circle`,
                    },
                    {
                        route: {
                            name: `EditAboutUs`,
                            params: { id: 'about-us' },
                        },
                        title: `About Us`,
                        icon: `zmdi zmdi-info`,
                    },
                    {
                        route: {
                            name: `EditOurMoto`,
                            params: { id: 'our-moto' },
                        },
                        title: `Our Moto`,
                        icon: `zmdi zmdi-quote`,
                    },
                    {
                        route: {
                            name: `EditOurMission`,
                            params: { id: 'our-mission' },
                        },
                        title: `Our Mission`,
                        icon: `zmdi zmdi-flag`,
                    },
                    {
                        route: {
                            name: `EditOurVision`,
                            params: { id: 'our-vision' },
                        },
                        title: `Our Vision`,
                        icon: `zmdi zmdi-eye`,
                    },
                    {
                        route: {
                            name: `EditOurTeam`,
                            params: { id: 'our-team' },
                        },
                        title: `Our Team`,
                        icon: `zmdi zmdi-accounts`,
                    },
                    {
                        route_name: `AllFaq`,
                        title: `FAQs`,
                        icon: `zmdi zmdi-help-outline`,
                    },
                    {
                        route: {
                            name: `EditPrivacyPolicy`,
                            params: { id: 'privacy-policy' },
                        },
                        title: `Privacy Policy`,
                        icon: `zmdi zmdi-lock`,
                    },
                    {
                        route: {
                            name: `EditRefundPolicy`,
                            params: { id: 'refund-policy' },
                        },
                        title: `Refund Policy`,
                        icon: `zmdi zmdi-money`,
                    },
                    {
                        route: {
                            name: `EditCookiePolicy`,
                            params: { id: 'cookie-policy' },
                        },
                        title: `Cookie Policy`,
                        icon: `zmdi zmdi-settings`,
                    },
                    {
                        route: {
                            name: `EditTermConditionPolicy`,
                            params: { id: 'term-condition-policy' },
                        },
                        title: `Terms & Conditions`,
                        icon: `zmdi zmdi-file-text`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-blog`"
                :menu_title="`Blog Management`"
                :menus="[
                    {
                        route_name: `AllBlogCategory`,
                        title: `Blog Category`,
                        icon: `zmdi zmdi-folder`,
                    },
                    {
                        route_name: `AllBlog`,
                        title: `All Blogs`,
                        icon: `zmdi zmdi-edit`,
                    },
                    {
                        route_name: `AllBlogWriter`,
                        title: `Blog Writers`,
                        icon: `zmdi zmdi-account-edit`,
                    },
                    {
                        route_name: `AllBlogTag`,
                        title: `Blog Tags`,
                        icon: `zmdi zmdi-label`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-images`"
                :menu_title="`Gallery`"
                :menus="[
                    {
                        route_name: `AllGalleryCategory`,
                        title: `Gallery Category`,
                        icon: `zmdi zmdi-folder`,
                    },
                    {
                        route_name: `AllGallery`,
                        title: `All Gallery`,
                        icon: `zmdi zmdi-image`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-film`"
                :menu_title="`Video Management`"
                :menus="[
                    {
                        route_name: `AllOurVideoCategory`,
                        title: `Video Category`,
                        icon: `zmdi zmdi-folder`,
                    },
                    {
                        route_name: `AllOurVideo`,
                        title: `Our Videos`,
                        icon: `zmdi zmdi-play-circle`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-gear`"
                :menu_title="`Configuration`"
                :menus="[
                    {
                        route_name: `ConfigPaymentGateway`,
                        title: `Payment Gateway`,
                        icon: `zmdi zmdi-card`,
                    },
                    {
                        route_name: `ConfigEmail`,
                        title: `Email Config`,
                        icon: `zmdi zmdi-email`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-calendar-days`"
                :menu_title="`Seminar Management`"
                :menus="[
                    {
                        route_name: `AllSeminer`,
                        title: `Seminars`,
                        icon: `zmdi zmdi-calendar-note`,
                    },
                    {
                        route_name: `AllSeminerParticipant`,
                        title: `Participants`,
                        icon: `zmdi zmdi-accounts`,
                    },
                    {
                        route_name: `AllSeminerSubscribers`,
                        title: `Subscribers`,
                        icon: `zmdi zmdi-email`,
                    },
                    {
                        route_name: `AllSeminerReviews`,
                        title: `Reviews`,
                        icon: `zmdi zmdi-star`,
                    },
                ]"
            />

            <side-bar-drop-down-menus
                :icon="`fa-solid fa-comments`"
                :menu_title="`Communication`"
                :menus="[
                    {
                        route_name: `AllContactMessage`,
                        title: `Contact Messages`,
                        icon: `zmdi zmdi-comment-text`,
                    },
                    {
                        route_name: `AllSubscriber`,
                        title: `Subscribers`,
                        icon: `zmdi zmdi-email`,
                    },
                ]"
            />

            <!-- Management end -->
        </ul>
    </div>
</template>

<script>
//auth_store
import { auth_store } from "../../../../../GlobalStore/auth_store";
import { site_settings_store } from "../../../../../GlobalStore/site_settings_store";
import { mapState, mapActions } from "pinia";
//components
import SideBarDropDownMenus from "./SideBarDropDownMenus.vue";
import SideBarSingleMenu from "./SideBarSingleMenu.vue";
export default {
    components: { SideBarDropDownMenus, SideBarSingleMenu },
    methods: {
        ...mapActions(site_settings_store, {
            get_setting_value: "get_setting_value",
        }),

        logout_submit: function () {
            let confirm = window.confirm("logout");
            if (confirm) {
                this.log_out();
            }
        },
        toggle_menu: function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        },
        hide_menu: function () {
            document.getElementById("wrapper").classList.add("toggled");
        },
        onDashboardClick() {
            // Close all dropdown menus when dashboard is clicked
            window.dispatchEvent(
                new CustomEvent("collapse-all-menus", {
                    detail: { except: null },
                }),
            );
        },
    },
    watch: {
        $route(to, from) {
            // Auto-hide sidebar when navigating to task board
            if (to.name === "TaskBoard") {
                this.hide_menu();
            }
        },
    },
    computed: {
        ...mapState(auth_store, {
            auth_info: "auth_info",
        }),
    },
};
</script>

<style>
/* Dashboard active state styling */
#menu > li.active > a,
#menu > li > a.active {
    background-color: #007bff !important;
    color: white !important;
    border-radius: 4px;
    margin: 2px;
}
</style>
<!-- <side-bar-drop-down-menus :icon="`fa fa-plus`" :icon_image="`https://files.etek.com.bd/images/icon_sales.png`"
    :menu_title="`title Management`" :menus="[
                {
                    route_name: `AllUser`,
                    title: `title`,
                    icon: `zmdi zmdi-dot-circle-alt`,
                },
            ]" /> -->
