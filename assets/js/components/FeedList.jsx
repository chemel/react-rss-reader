import React, {useState, useEffect} from "react";
import FeedApi from "../services/FeedApi";

function FeedList(props) {
    const [feeds, setFeeds] = useState([]);

    async function getFeeds() {
        try {
            const data = await FeedApi.findAll();
            setFeeds(data);
        } catch (error) {
            console.log('Unable to fetch feeds list');
        }
    };

    useEffect(() => {
        getFeeds();
    }, []);

    return (
        <div id="feed-list">
            <ul>
                {feeds.map(feed => (
                    <li key={feed.id} onClick={() => props.setFeedId(feed.id)}>{feed.title}</li>
                ))}
            </ul>
        </div>
    );
}

export default FeedList;
