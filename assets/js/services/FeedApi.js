import axios from 'axios';

async function findAll() {
    return axios
        .get('http://127.0.0.1:8000/api/feeds')
        .then(response => {
            const feeds = response.data['hydra:member'];
            return feeds;
        });
}

export default {
    findAll
};
