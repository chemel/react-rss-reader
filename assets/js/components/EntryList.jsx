import React, {useEffect, useState} from "react";
import EntryApi from "../services/EntryApi";

function EntryList(props) {
    const [entries, setEntries] = useState([]);

    async function getEntries(feedId) {
        if(feedId === null) {
            return;
        }
        try {
            const data = await EntryApi.findByFeed(feedId);
            setEntries(data);
        } catch (error) {
            console.log('Unable to fetch feed entries list');
        }
    }

    useEffect(() => {
        getEntries(props.feedId);
    }, [props.feedId]);

    function handleClick(entry) {
        props.setEntryId(entry.id);
        entry.readed = true;
    }

    return (
        <div id="entry-list">
            <ul>
                {entries.map(entry => (
                    <li key={entry.id} className={entry.readed == null ? 'unread' : ''} onClick={() => handleClick(entry)}>{entry.title}</li>
                ))}
            </ul>
        </div>
    );
}

export default EntryList;
