import axios from 'axios';

async function findAll() {
    return axios
        .get('http://127.0.0.1:8000/api/entries')
        .then(response => {
            const entries = response.data['hydra:member'];
            return entries;
        });
}

async function findByFeed(id) {
    return axios
        .get('http://127.0.0.1:8000/api/feed/' + id + '/entries')
        .then(response => {
            const entries = response.data['hydra:member'];
            return entries;
        });
}

export default {
    findAll,
    findByFeed
};
