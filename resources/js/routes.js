const CategoryList = () => import('./components/category/List.vue')
const CategoryCreate = () => import('./components/category/Add.vue')
const CategoryEdit = () => import('./components/category/Edit.vue')

const TagList = () => import('./components/tag/List.vue')
const TagCreate = () => import('./components/tag/Add.vue')
const TagEdit = () => import('./components/tag/Edit.vue')


const ProductList = () => import('./components/product/List.vue')
const ProductCreate = () => import('./components/product/Add.vue')
const ProductEdit = () => import('./components/product/Edit.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: ProductList
    },
    {
        name: 'categoryList',
        path: '/category',
        component: CategoryList
    },
    {
        name: 'categoryEdit',
        path: '/category/:id/edit',
        component: CategoryEdit
    },
    {
        name: 'categoryAdd',
        path: '/category/add',
        component: CategoryCreate
    },
    {
        name: 'tagList',
        path: '/tag',
        component: TagList
    },
    {
        name: 'tagEdit',
        path: '/tag/:id/edit',
        component: TagEdit
    },
    {
        name: 'tagAdd',
        path: '/tag/add',
        component: TagCreate
    },
    {
        name: 'productList',
        path: '/product',
        component: ProductList
    },
    {
        name: 'productEdit',
        path: '/product/:id/edit',
        component: ProductEdit
    },
    {
        name: 'productAdd',
        path: '/product/add',
        component: ProductCreate
    }
]