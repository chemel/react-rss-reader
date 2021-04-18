import { API_BASE_URL } from "../config";

async function findAll() {
    return await fetch(API_BASE_URL + '/entries')
        .then(response => response.json())
        .then(json => {
            return json['hydra:member']
        });
}

async function findByFeed(id) {
    return await fetch(API_BASE_URL + '/feed/{id}/entries'.replace('{id}', id))
        .then(response => response.json())
        .then(json => {
            return json['hydra:member']
        });
}

async function findById(id) {
    return await fetch(API_BASE_URL + '/entries/{id}'.replace('{id}', id))
        .then(response => response.json())
        .then(json => {
            return json
        });
}

export default {
    findAll,
    findByFeed,
    findById
};
