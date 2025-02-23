import { Component } from '@angular/core';
import { FormGroup, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';

import { AuthService } from '../../_services/auth.service';

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
  imports: [ReactiveFormsModule],
})
export class LogoutComponent {
  public logoutForm = new FormGroup({});

  constructor(private router: Router, private authService: AuthService) {}

  onSubmit() {
    if (this.logoutForm.valid) {
      this.authService.logout().subscribe();
      this.authService.removeToken();
      this.router.navigate(['login']);
    }
  }
}
