import React from "react";
import EntryApi from "../services/EntryApi";

class EntryList extends React.Component {

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
            var data = [];
            if (this.props.feed !== null) {
                data = await EntryApi.findByFeed(this.props.feed);
            }
            else {
                data = await EntryApi.findAll();
            }
            this.setState({
                isLoaded: true,
                items: data
            });
        } catch (error) {
            console.log('Unable to fetch entries list : ' + error);
            this.setState({
                isLoaded: true,
                items: [],
                error
            });
        }
    };

    componentDidMount() {
        this.fetch();
    }

    componentDidUpdate(prevProps) {
        if (this.props.feed !== prevProps.feed) {
            this.fetch();
        }
    }

    render() {
        return (
            <div id="entry-list">
                <ul>
                    {this.state.items.map(entry => (
                        <li key={entry.id} data-id={entry.id}>{entry.title}</li>
                    ))}
                </ul>
            </div>
        );
    }
};

export default EntryList;
