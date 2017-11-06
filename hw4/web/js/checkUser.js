checkUser = () => {
    let curFile = location.pathname.substring(location.pathname.lastIndexOf("/") + 1).trim();
    if (localStorage.getItem('user') !== null) {
        if (curFile !== 'list.html' && curFile !== 'filelist.html' && curFile !== 'user.html') {
            location = 'list.html';
        }
    } else {
        if (curFile !== 'index.html' && curFile !== 'reg.html') {
            location = 'index.html';
        }
    }
};

checkUser();