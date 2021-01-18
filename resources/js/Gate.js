export default class Gate{

    constructor(user){
        this.user = user;
    }


    isAdmin(){
        return this.user.type === 'Admin';
    }

    isUser(){
        return this.user.type === 'User';
    }
    isAdminOrAuthor(){
        if(this.user.type === 'Admin' || this.user.type === 'author'){
            return true;
        }

    }
    isAuthorOrUser(){
        if(this.user.type === 'User' || this.user.type === 'author'){
            return true;
        }

    }



}