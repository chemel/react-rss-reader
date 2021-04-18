import React, {useEffect, useState} from "react";
import EntryApi from "../services/EntryApi";

function Entry(props) {
    const [entry, setEntry] = useState(null);

    async function getEntry(entryId) {
        if(entryId === null) {
            return;
        }
        try {
            const data = await EntryApi.findById(entryId);
            setEntry(data);
        } catch (error) {
            console.log('Unable to fetch entry');
        }

        try {
            EntryApi.readed(entryId);
        } catch (error) {

        }
    }

    useEffect(() => {
        getEntry(props.entryId);
    }, [props.entryId]);

    return (
        <div id="entry">
            {entry &&
                <>
                    <h1>{ entry.title }</h1>
                    <p><a target="_blank" href={ entry.permalink }>{ entry.permalink }</a></p>
                    <div className="entry-content">
                        {entry.content}
                    </div>
                </>
            }
        </div>
    );
}

export default Entry;
