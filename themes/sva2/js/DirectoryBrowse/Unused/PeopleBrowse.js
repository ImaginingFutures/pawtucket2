import React, { useContext, useState, useEffect } from 'react';
// import { DirectoryBrowseContext } from './DirectoryBrowseContext';
// import BrowseBar from "./BrowseBar";
// import BrowseContentContainer from './BrowseContentContainer';
// import { getBrowseBar, getBrowseContent } from './DirectoryQueries';


const currentBrowse = pawtucketUIApps.DirectoryBrowse.currentBrowse;
const baseUrl = pawtucketUIApps.DirectoryBrowse.baseUrl;

const PeopleBrowse = () => {
  // const { browseBarData, setBrowseBarData, browseContentData, setBrowseContentData, start, setStart, limit, setLimit } = useContext(DirectoryBrowseContext);
  // const [ displayTitle, setDisplayTitle ] = useState();

  // useEffect(() => {
  //   getBrowseBar(baseUrl, currentBrowse, function (data) {
  //     // console.log('browseBar data', data);
  //     const values = [ ];
  //     data.values.map((val) => {
  //       // console.log(val);
  //       values.push(val);
  //     })
  //     setDisplayTitle(data.displayTitle)
  //     setBrowseBarData(values);
  //   });

  //   getBrowseContent(baseUrl, currentBrowse, "A", start, limit, (data) => {
  //     // console.log('browseContent data', data);
  //     const values = [];
  //     data.values.map((val) => {
  //       values.push(val.display);
  //     })
  //     setBrowseContentData(values);
  //   })
  // }, [setBrowseBarData])

  return (
    <div className="people-browse">
      <div className="row mb-2">
        <h2>Browse All by {displayTitle}</h2>
      </div>
      {/* <BrowseBar data={browseBarData} />
      <BrowseContentContainer data={browseContentData} /> */}
    </div>
  )
 
}

export default PeopleBrowse;
