import React from "react";
import FeedApi from "../services/FeedApi";

class FeedList extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            error: null,
            isLoaded: false,
            items: []
        };
    };

    async fetch() {
        try {
            const data = await FeedApi.findAll();
            this.setState({
                isLoaded: true,
                items: data
            });
        } catch (error) {
            console.log('Unable to fetch feed list');
            this.setState({
                isLoaded: true,
                error
            });
        }
    };

    componentDidMount() {
        this.fetch();
    }

    render() {
        return (
            <div id="feed-list">
                <ul>
                    {this.state.items.map(feed => (
                        <li key={feed.id} data-id={feed.id} onClick={ () => this.props.selectFeed(feed.id) }>{feed.title}</li>
                    ))}
                </ul>
            </div>
        );
    }
};

export default FeedList;
