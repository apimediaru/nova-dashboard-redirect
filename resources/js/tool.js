const getRedirect = () => {
  const { redirect } = Nova.config.NovaDashboardRedirect;
  if (!redirect) {
    return false;
  }

  if (typeof redirect === 'string') {
    return { path: redirect };
  }

  return redirect;
}

Nova.booting((Vue, router, store) => {
  const redirect = getRedirect();

  if (redirect) {
    router.beforeEach((to, from, next) => {
      if (to.name === 'dashboard.custom' && to.params.name === 'main') {
        next(redirect);
      }

      next();
    });
  }
});
