import { createWebHistory, createRouter } from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';



import Books from '../components/Books';
import AddBook from '../components/AddBook';
import EditBook from '../components/EditBook';




// NEWLY EDITED FOR ADMIN DASHBOARD


// FOR HOME
import FrontIndex from '../frontend/FrontIndex';
import AdminDashboard from '../admin/AdminDashboard';
import SettingForm from '../admin/setting/SettingForm';


// FOR BANNER
import BannerCreate from '../admin/banner/BannerCreate';
import BannerEdit from '../admin/banner/BannerEdit';
import BannerList from '../admin/banner/BannerList';


// FOR SKILL
import AddSkill from '../admin/skill/AddSkill';
import SkillList from '../admin/skill/SkillList';
import EditSkill from '../admin/skill/EditSkill';


// FOR PORTFOLIO
import PortfolioCreate from '../admin/portfolio/PortfolioCreate';
import PortfolioEdit from '../admin/portfolio/PortfolioEdit';
import PortfolioList from '../admin/portfolio/PortfolioList';


// FOR SERVICE
import ServiceCreate from '../admin/service/ServiceCreate';
import ServiceEdit from '../admin/service/ServiceEdit';
import ServiceList from '../admin/service/ServiceList';




// For Blog
import BlogCreate from '../admin/blog/BlogCreate';
import BlogEdit from '../admin/blog/BlogEdit';
import BlogList from '../admin/blog/BlogList';


// FOR PROFILE
import ProfileEdit from '../admin/profile/ProfileEdit';



export const routes = [{
        name: 'home',
        path: '/',
        component: FrontIndex,
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'user-home',
        path: '/user/home',
        component: Dashboard
    },
    {
        name: 'books',
        path: '/books',
        component: Books
    },
    {
        name: 'addbook',
        path: '/books/add',
        component: AddBook
    },
    {
        name: 'editbook',
        path: '/books/edit/:id',
        component: EditBook
    },
    {
        name: 'admin-home',
        path: '/admin/home',
        component: AdminDashboard,
    },
    {
        name: 'admin-setting',
        path: '/admin/setting',
        component: SettingForm,

    },
    {
        name: 'banner-create',
        path: '/admin/banner/create',
        component: BannerCreate,
    },
    {
        name: 'banner-edit',
        path: '/admin/banner/:id',
        component: BannerEdit,
    },
    {
        name: 'banner-list',
        path: '/admin/banner',
        component: BannerList,
    },
    {
        name: 'skill-create',
        path: '/admin/skill/create',
        component: AddSkill,
    },
    {
        name: 'skill-list',
        path: '/admin/skill',
        component: SkillList,
    },
    {
        name: 'skill-edit',
        path: '/admin/skill/:id',
        component: EditSkill,
    },
    {
        name: 'portfolio-create',
        path: '/admin/portfolio/create',
        component: PortfolioCreate,
    },
    {
        name: 'portfolio-list',
        path: '/admin/portfolio',
        component: PortfolioList,
    },
    {
        name: 'portfolio-edit',
        path: '/admin/portfolio/:id',
        component: PortfolioEdit,
    },
    {
        name: 'service-create',
        path: '/admin/service/create',
        component: ServiceCreate,
    },
    {
        name: 'service-list',
        path: '/admin/service',
        component: ServiceList,
    },
    {
        name: 'service-edit',
        path: '/admin/service/:id',
        component: ServiceEdit,
    },
    {
        name: 'blog-create',
        path: '/admin/blog/create',
        component: BlogCreate,
    },
    {
        name: 'blog-list',
        path: '/admin/blog',
        component: BlogList,
    },
    {
        name: 'blog-edit',
        path: '/admin/blog/:id',
        component: BlogEdit,
    },
    {
        name: 'profile-edit',
        path: '/admin/profile',
        component: ProfileEdit,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;