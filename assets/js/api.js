'use strict';

const api_key = '9affc4544c000ff68a5a74f4350cbb32';
const imageBaseURL = 'https://image.tmdb.org/t/p/';

// fetch data from server using aurl and passes
// the result in json data to a callback function
// along with an optional parameter if has optionalParam


const fetchdataFromServer = function (url, callback , optionalParam) {
    fetch(url)
    .then(response => response.json())
    .then(data => callback(data, optionalParam));
}


export { imageBaseURL, api_key, fetchdataFromServer};
