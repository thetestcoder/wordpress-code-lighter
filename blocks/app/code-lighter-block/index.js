import './editor.scss';

import languages from "./languages";


const {registerBlockType} = wp.blocks;
const {__} = wp.i18n;

const {
    InspectorControls,
} = wp.blockEditor;

const {} = wp.components;

registerBlockType('code-lighter/highlighter', {
        title: __("Highlighter", 'code-lighter'),
        description: __("Add Your Code and we will Light it Up", 'code-lighter'),
        category: 'common',
        keywords: [
            __('Highlighter', 'code-lighter'),
            __('Code Lighter', 'code-lighter'),
            __('Code Highlighter', 'code-lighter'),
        ],
        supports: {
            html: true,
            customClassName: true
        },
        attributes: {
            language: {
                type: 'string',
                default: "plaintext"
            },
            code: {
                type: 'string',
                default: ""
            },
            langName: {
                type: "string",
                default: "Plain Text"
            }

        },
        edit: (props) => {
            const updateLanguage = (event) => {
                props.setAttributes({language: event.target.value});
                updateLangName(event.target);
            };
            const updateCode = (event) => props.setAttributes({code: event.target.value});
            const updateLangName = (target) => {
                props.setAttributes({
                    langName: target
                        .options[target.selectedIndex]
                        .getAttribute('data-name')
                })
            }

            return <div className={'highlighter'}>
                <div className={'mb-2'}>
                    <label className={'form-label text-center text-white fw-bold'} htmlFor="lang">Language</label>
                    <select
                        id="lang"
                        onChange={updateLanguage}
                        className={'form-select-custom'}
                        value={props.attributes.language}
                    >
                        {
                            languages.map((lang, index) => {
                                return <option key={index} value={lang.value} data-name={lang.name}>{lang.name}</option>
                            })
                        }
                    </select>
                </div>
                <div className={'mb-2'}>
                    <label className={'form-label text-center text-white fw-bold'} htmlFor="code">Code</label>
                    <textarea
                        onChange={updateCode}
                        id="code"
                        cols="30"
                        rows="10"
                        className={'form-control editor'}
                    >
                        {props.attributes.code}
                    </textarea>
                </div>
            </div>
        },
        save: (props) => {
            return (
                <div>
                    <div className={'relative-box'}>
                        <span className={"lang"}>{props.attributes.langName}</span>
                        <span className={"copy-button"}>Copy</span>
                        <pre>
                           <code className={props.attributes.language}>
                               {props.attributes.code}
                           </code>
                        </pre>
                    </div>
                </div>
            );
        }

    }
);