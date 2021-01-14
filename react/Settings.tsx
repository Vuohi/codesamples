import React from 'react';
import { useSelector } from 'react-redux';
import styled from 'styled-components';
import { RootState, TagData } from '../../types';
import Loading from '../Loading';
import Tag from './Tag';

const Wrapper = styled.div`
  font-family: 'Helvetica', sans-serif;
`;

const Title = styled.h1`
  color: #274262;
  font-size: 40px;
  margin-top: 0;
  margin-bottom: 0;
  @media (max-width: 768px) {
    font-size: 24px;
  }
`;

const Headers = styled.div`
  display: flex;
  font-weight: bold;
  padding-bottom: 3px;
  border-bottom: 2px solid #274262;
  @media (max-width: 768px) {
    display: none;
  }
`;

const Name = styled.div`
  min-width: 120px;
`;

const Mac = styled.div`
  min-width: 160px;
`;

const TheRest = styled.div`
  width: 100px;
`;

const Settings = () => {
  const tags: TagData[] = useSelector((state: RootState) => state.tags);

  return (
    <Wrapper>
      <Title>Settings</Title>
      {tags.length === 0 ? (
        <Loading text="Loading tags" />
      ) : (
        <>
          <Headers>
            <Name>Name</Name>
            <Mac>Mac</Mac>
            <TheRest>Lower limit</TheRest>
            <TheRest>Active</TheRest>
            <TheRest>Higher limit</TheRest>
            <TheRest>Active</TheRest>
          </Headers>
          {tags.map((tag) => (
            <Tag key={tag.tagName} tag={tag} />
          ))}
        </>
      )}
    </Wrapper>
  );
};

export default Settings;
