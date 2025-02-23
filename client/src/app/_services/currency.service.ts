import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { BASE_API_URI } from '../app.config';

interface Currency {
  id: string;
}

export interface Currencies {
  data: Array<Currency>;
}

@Injectable({
  providedIn: 'root',
})
export class CurrencyService {
  constructor(private http: HttpClient) {}

  currencies(): Observable<Currencies> {
    return this.http.get<Currencies>(BASE_API_URI + 'currencies');
  }
}
