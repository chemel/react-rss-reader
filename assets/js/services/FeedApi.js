import { API_BASE_URL } from '../config'

async function findAll() {
    return await fetch(API_BASE_URL + '/feeds')
        .then(response => response.json())
        .then(json => {
            return json['hydra:member']
        });
}

export default {
    findAll
};
