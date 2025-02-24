import { Component, signal } from '@angular/core';
import {
  FormGroup,
  FormControl,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { Router } from '@angular/router';

import { AuthService } from '../../_services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  imports: [ReactiveFormsModule],
})
export class LoginComponent {
  public formError = signal<string>('');

  public loginForm = new FormGroup({
    email: new FormControl('glauber@airosoftware.com', [
      Validators.required,
      Validators.email,
    ]),
    password: new FormControl('password', [Validators.required]),
  });

  constructor(private router: Router, private authService: AuthService) {}

  get email() {
    return this.loginForm.get('email');
  }

  get password() {
    return this.loginForm.get('password');
  }

  onSubmit() {
    if (this.loginForm.valid) {
      const { email, password } = this.loginForm.value;

      this.authService.login(email, password).subscribe({
        next: (res) => {
          this.authService.setToken(res.token);
          this.router.navigate(['']);
        },
        error: (error) => {
          this.formError.set(error.error.message);
        },
      });
    }
  }
}
