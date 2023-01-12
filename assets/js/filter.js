const 

async function applyFilter(event) {
    event.preventDefault()
    let filterLink = event.currentTarget;
    let link = filterLink.href;

    const response = await fetch(link, {
        headers: {
            'X-Requested-with': 'XMLHttpRequest'
        }
    })
    if (response.status >= 200 && response.status < 300) {
        const data = await response.json()
        content.innerHTML = data.content

        history.replaceState({}, '', link)
    }
}