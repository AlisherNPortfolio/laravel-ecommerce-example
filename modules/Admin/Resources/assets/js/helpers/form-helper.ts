class FormHelper {
    private data: FormData = new FormData();
    public fileWrapper: string = 'images';

    constructor (formContent: object) {
        this.generateFormData(formContent);
    }

    private generateFormData(formContent: object): void {
        if (Array.isArray(formContent)) {
            this.appendArray(formContent);
        } else {
            for (let form in formContent) {
                const value = formContent[form as keyof object];
                if (Array.isArray(value)) {
                    this.appendArray(value);
                } else {
                    this.append(form, value);
                }

            }
        }
    }

    private appendArray(data: any[]) {
        data.forEach((val: any, index: number) => {
            const key = val instanceof File ? `${this.fileWrapper}[${index}]` : String(index);
            this.append(key, val);
        })
    }

    private append(key: string, value: any): void {
        this.data.append(key, value);
    }

    public getForm() {
        return this.data;
    }
}

export default FormHelper;
