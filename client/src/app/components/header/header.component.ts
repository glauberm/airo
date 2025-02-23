import { Component, input, OnInit, signal } from '@angular/core';

import { LogoutComponent } from '../logout/logout.component';
import { AuthService } from '../../_services/auth.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  imports: [LogoutComponent],
})
export class HeaderComponent implements OnInit {
  public hasToken = signal<boolean>(false);

  constructor(private authService: AuthService) {}

  ngOnInit(): void {
    this.hasToken.set(this.authService.getToken() !== null);

    this.authService.eventEmitter.subscribe((event) => {
      console.log(event);
      this.hasToken.set(event.hasToken);
    });
  }
}
