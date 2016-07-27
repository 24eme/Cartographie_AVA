if (typeof getRandomColor === "undefined") {
    var getRandomColor = function(type) {
        var _c;

        if (type)  type = type.toUpperCase();

        switch (type) {
        case "RGB":
            _c = "rgb(" + (Math.random() * 256 | 0) + ", " + (Math.random() * 256 | 0) + ", " + (Math.random() * 256 | 0) + ")";
            break;
        case "RGBA":
            _c = "rgba(" + (Math.random() * 256 | 0) + ", " + (Math.random() * 256 | 0) + ", " + (Math.random() * 256 | 0) + ", " + (Math.random() * 101 | 0) / 100 + ")";
            break;
        case "HSL":
            _c = "hsl(" + (Math.random() * 361 | 0) + ", " + (Math.random() * 101 | 0) + "%, " + (Math.random() * 101 | 0) + "%)";
            break;
        case "HSLA":
            _c = "hsla(" + (Math.random() * 361 | 0) + ", " + (Math.random() * 101 | 0) + "%, " + (Math.random() * 101 | 0) + "%, " + (Math.random() * 101 | 0) / 100 + ")";
            break;
        default:
            _c = "#" + ("000000" + (Math.random() * 0x1000000 | 0).toString(16)).substr(-6);
            break;
        }

        if (/^(MSF|AHEX)$/.test(type))  _c += ("00" + (Math.random() * 256 | 0).toString(16)).substr(-2);

        return _c;
    };
}