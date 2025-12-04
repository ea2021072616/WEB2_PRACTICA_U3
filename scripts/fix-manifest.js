import { promises as fs } from 'fs';
import path from 'path';

(async () => {
    try {
        const root = process.cwd();
        const src = path.join(root, 'public', 'build', '.vite', 'manifest.json');
        const dest = path.join(root, 'public', 'build', 'manifest.json');

        const data = await fs.readFile(src, 'utf8');
        await fs.writeFile(dest, data, 'utf8');
        console.log('Copied manifest to', dest);
    } catch (err) {
        if (err.code === 'ENOENT') {
            console.error('Manifest source file not found. Expected at public/build/.vite/manifest.json');
            process.exit(0);
        }
        console.error(err);
        process.exit(1);
    }
})();
