const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    meta: { requiresAuth: true },
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: '/users', component: () => import('pages/User/UserList.vue') },
      { path: '/users/create', component: () => import('pages/User/UserForm.vue') },
      { path: '/users/:id/edit', component: () => import('pages/User/UserForm.vue') },
      { path: '/profiles', component: () => import('pages/Profile/ProfileList.vue') },
      { path: '/profiles/create', component: () => import('pages/Profile/ProfileForm.vue') },
      { path: '/profiles/:id/edit', component: () => import('pages/Profile/ProfileForm.vue') },
    ]
  },
  {
    path: '/login',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      {
        path: '',
        component: () => import('src/pages/Auth/LoginPage.vue')
      }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
