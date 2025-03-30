const routes = [
  {
    path: '/',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: '/register', component: () => import('pages/RegisterPage.vue') },
      { path: '/login', component: () => import('pages/LoginPage.vue') },
      { path: '/send-verify', component: () => import('pages/SendVerify.vue') },
      { path: '/confirm-login/:number', component: () => import('pages/ConfirmLogin.vue') },
      { path: '/category', component: () => import('pages/CategoryPage.vue') },
      { path: '/create-category', component: () => import('pages/CreateCategory.vue') },
      { path: '/edit-category', component: () => import('pages/EditCategory.vue') },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
]

export default routes
