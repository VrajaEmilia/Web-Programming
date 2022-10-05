package com.example.server.model;

public class Website {
    private final int id;
    private final String url;
    int noDocuments;

    public Website(int id, String url, int noDocuments) {
        this.id = id;
        this.url = url;
        this.noDocuments = noDocuments;
    }

    public int getId() {
        return id;
    }

    public String getUrl() {
        return url;
    }

    public int getNoDocuments() {
        return noDocuments;
    }
}
