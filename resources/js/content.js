export class Content {
    buildAlert(contentData) {

        const parent = document.createElement('div');
        parent.className = 'alert alert-warning alert-dismissible';
        parent.setAttribute('id', 'myAlert')
        parent.setAttribute('role', 'alert')

        const child = document.createElement("p");
        child.className = "mb-0";

        const buttonClose = document.createElement('button');
        buttonClose.className = 'btn-close'
        buttonClose.setAttribute('type', 'button')
        buttonClose.setAttribute('data-bs-dismiss', 'alert');
        buttonClose.setAttribute('aria-label', 'Close');

        parent.appendChild(child);
        child.appendChild(contentData);
        parent.appendChild(buttonClose);

        return parent;
    }
}
