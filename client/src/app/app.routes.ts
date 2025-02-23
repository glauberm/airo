import { Routes } from '@angular/router';

import { QuotationComponent } from './components/quotation/quotation.component';
import { LoginComponent } from './components/login/login.component';
import { appGuard } from './app.guard';

export const routes: Routes = [
  { path: '', component: QuotationComponent, canActivate: [appGuard] },
  { path: 'login', component: LoginComponent },
];
