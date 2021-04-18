import React, { useState } from "react";
import FeedList from './FeedList';
import EntryList from './EntryList';
import Entry from './Entry';

function NewsReader() {
    const [feedId, setFeedId] = useState(null);
    const [entryId, setEntryId] = useState(null);

    return (
        <div id="board">
            <FeedList setFeedId={setFeedId} />
            <EntryList feedId={feedId} setEntryId={setEntryId} />
            <Entry entryId={entryId} />
        </div>
    );
}

export default NewsReader;
