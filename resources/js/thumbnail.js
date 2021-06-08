thumbnail.onchange = evt => {
    const [file] = thumbnail.files
    if (file) {
      imgThumbnail.src = URL.createObjectURL(file)
    }
}
