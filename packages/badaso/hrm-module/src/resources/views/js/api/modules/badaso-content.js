import resource from "../../../../../../core/src/resources/js/api/resource";
import QueryString from "../../../../../../core/src/resources/js/api/query-string";

let apiPrefix = process.env.MIX_API_ROUTE_PREFIX
    ? "/" + process.env.MIX_API_ROUTE_PREFIX
    : "/badaso-api";

export default {
    exampleRequest(data = {}) {
        let ep = apiPrefix + "/module/content/v1/content"; // path url request
        let qs = QueryString(data); // change data to query string
        let url = ep + qs;  // compine url with query string
        return resource.get(url); // start request with axios
    }
};
