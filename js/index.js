function like(e) {
    e.classList.toggle('fas');
}

function show() {
    let x = document.getElementById('cat-cont');
    let x1 = document.getElementById('cat-cont1');
    let x2 = document.querySelector('#cat-cont1 div');
    let x3 = document.querySelector('#postUpload');
    x.classList.toggle('w3-hide-small');
    x.classList.toggle('w3-hide-medium');
    x1.classList.toggle('w3-hide-small');
    x1.classList.toggle('w3-hide-medium');
    x3.classList.toggle('w3-hide-small');
    x1.classList.toggle('w3-animate-opacity');
    x2.classList.toggle('border');
}

function filter(e){
	let state='none';
	if(e == 'post'){
		state='block';
	}
	else{
		state='none';
	}
    let post = document.getElementsByClassName('post');
    let filtered = document.getElementsByClassName(e);
    for(i=0;i<post.length;i++){
        post[i].style.display=state;
    }
    for(j=0;j<filtered.length;j++){
        filtered[j].style.display='block';
    }   
}