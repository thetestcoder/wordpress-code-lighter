import './editor.scss';

import languages from "./languages";

const {registerBlockType} = wp.blocks;
const {__} = wp.i18n;

const {
    InspectorControls,
    InnerBlocks
} = wp.blockEditor;

const {
    PanelBody,
    PanelRow,
    TextControl,
    SelectControl,
    TextareaControl
} = wp.components;

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
            }
        },
        edit: (props) => {
            const updateLanguage = (event) => {
                document.querySelectorAll('textarea.code').forEach(block => {
                    console.log("looking good");
                    hljs.highlightBlock(block);
                });
                props.setAttributes({language: event.target.value})
            };
            const updateCode = (event) => props.setAttributes({code: event.target.value});

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
                                return <option key={index} value={lang.value}>{lang.name}</option>
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
                        className={'form-control code ' + props.attributes.language}
                    >
                        {props.attributes.code}
                    </textarea>
                </div>
            </div>
        },
        save: (props) => {
            return (
                <div>
                    <pre>
                       <code className={props.attributes.language}>
                           {props.attributes.code}
                       </code>
                    </pre>
                </div>
            );
        }

    }
);