
function go() {
	const pubkeyInput = document.querySelector("#pubkey");
	const hexkeyInput = document.querySelector("#hexkey");
	hexkeyInput.addEventListener("input", () => {
		const hexkeyValue = hexkeyInput.value;
		// reghex to check is hexkey.
		const hexRegex = /^[0-9a-fA-F]+$/;
		// Check if string matches hex regex
		if (hexRegex.test(hexkeyValue)) {
			//console.log(`${hexkeyInput} is a valid hex key`);
			// Convert hex key to bytes
			const bytes = new Uint8Array(hexkeyValue.
				match(/.{1,2}/g).map(byte => parseInt(byte, 16)));
			// Encode bytes as Bech32-encoded string
			const words = bech32.toWords(bytes);
			const encodedKey = bech32.encode('npub', words);
			//console.log(encodedKey); // 
			// change the input.
			pubkeyInput.value = encodedKey;
		} else {
			//console.log(`${hexkeyInput} is not a valid hex key`);
		}	
	});
	// change hexkey to pubkey
	pubkeyInput.addEventListener("input", () => {
		const pubkeyValue = pubkeyInput.value;
		try {
			const decoded = bech32.decode(pubkeyValue);
			//console.log(`${pubkeyValue} is a valid Bech32-encoded string`);
			// Convert integer array to bytes
			const bytes = bech32.fromWords(decoded.words);
			// Convert bytes to hex key
			// you should add the buffer to avoid the slowlyness.
			//const hexkeyDecoded = Buffer.from(bytes).bytes.toString('hex');
			// "Buffer" is a complement from Node.js, so it doesn't work here,
			// we need another approach here, convert each pair to bytes
			// using another function incorporated. it is incoporated in Js.
			// it should detect first if string is too short, you will get errores
			// todo: fix the output errors when it is too short.
			const hexkeyDecoded = Array.prototype.
			map.call(new Uint8Array(bytes), x => ('00' + x.
			toString(16)).slice(-2)).join('');
			//console.log(hexkeyDecoded);
			// we change the input.
			hexkeyInput.value = hexkeyDecoded;
		  } catch (error) {
			//console.log(`${pubkeyValue} is not a valid Bech32-encoded string`);
			//console.log(error);
		  }		
	});
}

// start the function
go()

