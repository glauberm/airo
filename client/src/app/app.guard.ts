import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';

import { AuthService } from './_services/auth.service';

export const appGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);
  const token = inject(AuthService).getToken();

  if (token) {
    return true;
  }

  router.navigate(['login']);

  return false;
};
