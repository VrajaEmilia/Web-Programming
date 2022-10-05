import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialog, MatDialogRef} from "@angular/material/dialog";
import {HttpClient} from "@angular/common/http";
export interface DialogData {
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
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.css']
})
export class EditComponent implements OnInit {
  did:number;
  constructor(public dialogRef: MatDialogRef<EditComponent>,
              @Inject(MAT_DIALOG_DATA) public data: DialogData,public dialog: MatDialog,private http: HttpClient) {
    this.did=data.id;
  }

  ngOnInit(): void {
  }

  updateDoc() {
    var postData =
      {
        "id":this.did,
        "name":this.data.name,
        "website":this.data.website,
        "k1":this.data.k1,
        "k2":this.data.k2,
        "k3":this.data.k3,
        "k4":this.data.k4,
        "k5":this.data.k5
      }

      this.http.post("http://localhost:4200/api/updateDocument?id="+this.did,postData).subscribe(
        response=>{
          console.log(response);
          this.dialogRef.close();
          location.reload();
        }
      )

  }

  close() {
    this.dialogRef.close();
  }
}
