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
      { path: '/edit-category/:id', component: () => import('pages/EditCategory.vue') },
      { path: '/show-category/:id', component: () => import('pages/ShowCategory.vue') },
      { path: '/discover-post', component: () => import('pages/DiscoverPage.vue') },
      { path: '/create-post', component: () => import('pages/CreatePost.vue') },
      { path: '/edit-post/:id', component: () => import('pages/EditPost.vue') },
      { path: '/show-post/:id', component: () => import('pages/PostsPage.vue') },
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
