package com.example.server.model;

public class Document {
    private final int id;
    private final String name,website,k1,k2,k3,k4,k5;

    public Document(int id, String name, String website, String k1, String k2, String k3, String k4, String k5) {
        this.id = id;
        this.name = name;
        this.website = website;
        this.k1 = k1;
        this.k2 = k2;
        this.k3 = k3;
        this.k4 = k4;
        this.k5 = k5;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getWebsite() {
        return website;
    }

    public String getK1() {
        return k1;
    }

    public String getK2() {
        return k2;
    }

    public String getK3() {
        return k3;
    }

    public String getK4() {
        return k4;
    }

    public String getK5() {
        return k5;
    }
}
