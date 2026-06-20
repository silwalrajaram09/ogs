# TODO

- [x] Fix CommitteeController redirect route name (admin.committee.index)
- [ ] Harden authorization: implement authorize() checks in all admin FormRequest classes (return 403 for non-admin)
- [ ] (Optional) Add User::isAdmin() helper and reuse it in EnsureUserIsAdmin + requests
- [x] Fix broken empty admin Vue pages (so Vite build succeeds)
- [ ] Run sanity checks: php artisan route:list, php artisan test
