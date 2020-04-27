import React from "react";
import FeedList from './FeedList';
import EntryList from './EntryList';

class NewsReader extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            feed: null
        };
    };

    selectFeed(id) {
        this.setState({feed: id});
    }

    render() {
        return (
            <div id="board">
                <FeedList selectFeed={this.selectFeed.bind(this)} />
                <EntryList feed={this.state.feed}/>
            </div>
        );
    }
};

export default NewsReader;
