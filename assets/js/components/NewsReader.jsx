import React, { useState } from "react";
import FeedList from './FeedList';
import EntryList from './EntryList';

function NewsReader() {
    const [feedId, setFeedId] = useState(null);

    return (
        <div id="board">
            <FeedList setFeedId={setFeedId} />
            <EntryList feedId={feedId}/>
        </div>
    );
}

export default NewsReader;
