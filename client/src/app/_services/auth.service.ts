import { EventEmitter, Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { BASE_API_URI } from '../app.config';

const TOKEN_KEY = 'airo_token';

interface Token {
  token: string;
}

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  public eventEmitter = new EventEmitter<any>();

  constructor(private http: HttpClient) {}

  login(
    email: string | null | undefined,
    password: string | null | undefined
  ): Observable<Token> {
    return this.http.post<Token>(BASE_API_URI + 'login', { email, password });
  }

  logout(): Observable<void> {
    return this.http.post<void>(BASE_API_URI + 'logout', null);
  }

  refresh(): Observable<Token> {
    return this.http.post<Token>(BASE_API_URI + 'refresh', null);
  }

  getToken(): string | null {
    return localStorage.getItem(TOKEN_KEY);
  }

  setToken(token: string): void {
    localStorage.setItem(TOKEN_KEY, token);
    this.eventEmitter.emit({ hasToken: true });
  }

  removeToken(): void {
    localStorage.removeItem(TOKEN_KEY);
    this.eventEmitter.emit({ hasToken: false });
  }
}
