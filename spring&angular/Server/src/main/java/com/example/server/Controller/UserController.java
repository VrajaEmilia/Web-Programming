package com.example.server.Controller;

import com.example.server.model.Document;
import com.example.server.model.Website;
import com.mysql.cj.xdevapi.JsonArray;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.JdbcOperations;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@CrossOrigin
@RestController
public class UserController {
    @Autowired
    private JdbcOperations jdbcOperations;

    public UserController() {
        JdbcConfig jdbcConfig = new JdbcConfig();
        try {
            this.jdbcOperations = jdbcConfig.jdbcOperations();
        } catch (ClassNotFoundException e) {
            throw new RuntimeException(e);
        }
    }
    @GetMapping("getWebsites")
    public ArrayList<Website> getWebsites(){
        return new ArrayList<Website>(jdbcOperations.query("SELECT w.id,w.url,COUNT(d.wid) as nod\n" +
                "FROM websites w\n" +
                "INNER JOIN documents d\n" +
                "ON w.id=d.wid\n" +
                "GROUP by w.id",(rs,i)->
                new Website(rs.getInt("id"),rs.getString("url"),rs.getInt("nod"))
        ));
    }
    @GetMapping("getDocuments")
    public ArrayList<Document> getDocuments(){
        return new ArrayList<Document>(jdbcOperations.query("SELECT d.id,d.name,w.url,d.k1,d.k2,d.k3,d.k4,d.k5\n" +
                "From documents d\n" +
                "INNER JOIN websites w\n" +
                "on w.id=d.wid",(rs,i)->
                new Document(rs.getInt("id"),rs.getString("name"),rs.getString("url"),
                        rs.getString("k1"),rs.getString("k2"),rs.getString("k3"),
                        rs.getString("k4"),rs.getString("k5"))
        ));
    }
    @GetMapping("getDocument")
    public Optional<Document> getDocuments(@RequestParam(value = "id") int id){
        return jdbcOperations.query("SELECT d.id,d.name,w.url,d.k1,d.k2,d.k3,d.k4,d.k5\n" +
                "From documents d\n" +
                "INNER JOIN websites w\n" +
                "on w.id=d.wid WHERE d.id=" +id,(rs,i)->
                new Document(rs.getInt("id"),rs.getString("name"),rs.getString("url"),
                        rs.getString("k1"),rs.getString("k2"),rs.getString("k3"),
                        rs.getString("k4"),rs.getString("k5"))
        ).stream().findFirst();
    }

    @PostMapping("updateDocument")
    public String updateDocument(@RequestParam(value = "id") int id,@RequestBody Document doc){
        Integer rowsAffected = jdbcOperations.update(
                "UPDATE documents SET k1 = ?, k2 = ?, k3 = ?, k4=?, k5=? WHERE id = ?",
                doc.getK1(),doc.getK1(),doc.getK3(),doc.getK4(),doc.getK5(),id);
        if(rowsAffected.equals(0))
            return "{\"fail\":0}";
        return "{\"success\":1}";
    }

}
