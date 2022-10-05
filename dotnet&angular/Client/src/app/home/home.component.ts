import { Component, OnInit } from '@angular/core';
import {HttpClient} from "@angular/common/http";
export interface Article{
  username:string,
  journalName:string,
  summary:string,
  date:string
}
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  // @ts-ignore
  articles : Article[]
  username:string;
  journal:string;
  get = 0
  journalToAdd: string;
  summary:string;
  constructor(private http:HttpClient) {
    this.username=""
    this.journal=""
    this.journalToAdd=""
    this.summary=""
  }

  ngOnInit(): void {
  }

  getArt() {
    this.get=0;
    this.http.get('https://localhost:7149/api/getArticlesFromJournal?journal='+this.journal+'&username='+this.username)
      .subscribe(response=>{
        this.articles=Object.values(response);
        console.log(this.articles);
        this.get=1;
      })
  }

  add() {
     var postData = {
      "username":this.username,
       "journalName":this.journalToAdd,
       "summary":this.summary,
        "date":""
    }
    this.http.post("https://localhost:7149/api/add",postData).subscribe(response=>
    {console.log(response);
      this.journal=this.journalToAdd;
      this.getArt()}
    )
  }
}
