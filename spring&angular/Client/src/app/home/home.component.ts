import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {MatDialog} from "@angular/material/dialog";
import {EditComponent} from "../edit/edit.component";
export interface Website{
  url:string;
  noDocuments:number;
}
export interface Documents{
  id:number;
  name:string;
  website:string;
  k1:string;
  k2:string;
  k3:string;
  k4:string;
  k5:string;
}
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  columns = [
    {
      columnDef: 'url',
      header: 'url',
      cell: (element: Website) => `${element.url}`,
    },
    {
      columnDef: 'noDocuments',
      header: 'Number of Documents',
      cell: (element: Website) => `${element.noDocuments}`,
    }
  ];
  // @ts-ignore
  dataSource:Website[]
  displayedColumns = this.columns.map(c => c.columnDef);
  // @ts-ignore
  dataSourceDocs: Documents[];
  displayedColumnsDocs:  string[] = ['name', 'website', 'k1','k2','k3','k4','k5','actions'];
  noKeywords: number;
  keywords: String[];
  constructor(private http:HttpClient,public dialog: MatDialog) {
    this.noKeywords=0;
    this.keywords = [];
  }

  ngOnInit(): void {
    this.http.get("http://localhost:4200/api/getWebsites").subscribe(response=>{
      console.log(response);
      const websites = Object.values(response);

      let postArr: any[];
      postArr = [];
      websites.forEach(element => postArr.push(element));
      this.dataSource=postArr;
    })
    this.http.get('http://localhost:4200/api/getDocuments').subscribe(response=>
    {
      this.dataSourceDocs = Object.values(response);
    })
    this.noKeywords=0;
  }

  loadEdit(id: number) {
    console.log(id);
    Document
    this.http.get("http://localhost:4200/api/getDocument?id="+id).subscribe(response=>{
      var doc = Object.values(response);
      var d : Documents = {
        "id":doc[0],
        "name":doc[1],
        "website":doc[2],
        "k1":doc[3],
        "k2":doc[4],
        "k3":doc[5],
        "k4":doc[6],
        "k5":doc[7]
      }
      const dialogRef = this.dialog.open(EditComponent, {
        width: '500px',
        data: {"id":d.id,"name":d.name,"website":d.website,"k1":d.k1,"k2":d.k2,"k3":d.k3,"k4":d.k4,"k5":d.k5},
      });
    });
  }

  search() {
    console.log(this.keywords);
  }
}
