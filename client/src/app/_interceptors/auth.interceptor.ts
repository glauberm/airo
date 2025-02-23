import {
  HttpErrorResponse,
  HttpEvent,
  HttpHandlerFn,
  HttpRequest,
} from '@angular/common/http';
import { inject } from '@angular/core';
import { Router } from '@angular/router';
import { catchError, mergeMap, Observable, throwError } from 'rxjs';

import { AuthService } from '../_services/auth.service';

export function authInterceptor(
  req: HttpRequest<unknown>,
  next: HttpHandlerFn
): Observable<HttpEvent<unknown>> {
  const router = inject(Router);
  const authService = inject(AuthService);
  const token = authService.getToken();
  let isRetryRequest = false;

  if (!token) {
    router.navigate(['login']);
    return next(req);
  }

  const newReq = req.clone({
    headers: req.headers.set('Authorization', `Bearer ${token}`),
  });

  return next(newReq).pipe(
    catchError((error) => {
      if (
        error instanceof HttpErrorResponse &&
        error.status === 401 &&
        !req.url.includes('login')
      ) {
        if (!isRetryRequest) {
          isRetryRequest = true;

          return authService.refresh().pipe(
            mergeMap((res) => {
              const retryReq = newReq.clone({
                headers: newReq.headers.set(
                  'Authorization',
                  `Bearer ${res.token}`
                ),
              });

              return next(retryReq);
            }),
            catchError((error) => {
              authService.removeToken();
              router.navigate(['login']);

              return throwError(() => error);
            })
          );
        }
      }

      return throwError(() => error);
    })
  );
}
